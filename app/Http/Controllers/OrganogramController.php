<?php

namespace App\Http\Controllers;

use App\Models as Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganogramController extends Controller
{
    public function callAction($method, $parameters)
    {


        return parent::callAction($method, $parameters);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($department = null)
    {

        $models = Models\Organogram::query();
       // $department = 1;

        if ($department == null) {
            $models = $models->where('type', 1);
        } else {
            $models = $models->whereRaw('(ordering = -1 OR(`type`=0 and z__department_type_ids = ?) OR (type=1 and z__department_type_ids LIKE ?))')->setBindings([(int) $department, '%|'.(int) $department.'|%'])->orderBy('type', 'desc')->orderby('ordering', 'asc');
        }
        $models = $models->orderBy('id')->get()->toArray();

        $data = [];

        foreach ($models as $row) {


            $_data = [];
            $_data["id"] = $row["id"];
            $_data["parent"] = $row["parent_id"] == 0 ? "#" : $row["parent_id"];
            $_data["text"] = $row["name"];
            $_data["data"] = $row;
            $data[] = $_data;
        }

        return view('organogram.index', ['data' => $data, 'department' => $department]);
    }

    public function getWorkingPositions($work_pos = null, $working_position_ids)
    {
        $work_pos != null ?: $work_pos = Models\ZLibWorkingPosition::getList();

        $pos_ids = array_filter(explode('|', $working_position_ids));

        $work_pos_arr = [];
        foreach ($pos_ids as $v):
            $work_pos_arr[] = isset($work_pos[$v]) ? $work_pos[$v] : '';
        endforeach;

        $work_pos_str = implode(', ', array_filter($work_pos_arr));

        return ($work_pos_str ? sprintf(' <span class="work-pos">(%s)</span>', $work_pos_str) : '');
    }

    public function create(Request $request)
    {


        $model = new Models\Organogram();
        $ok = $this->_save($request, $model);

        $work_pos_span = null;
        $is_manager = null;

        if ($request->get('type') == 0) { //employee
            $work_pos = Models\ZLibWorkingPosition::getList();
            $work_pos_span = $this->getWorkingPositions($work_pos, $model->z__lib_working_position_ids);

            $managers = DB::table('z__rel_is_manager')->pluck('table2_id')->toArray();

            $work_pos_ids = $model->z__lib_working_position_ids;

            $pos_ids = explode("|", $model->z__lib_working_position_ids);

            $is_manager = false;
            foreach ($pos_ids as $pid) {
                if (in_array($pid, $managers)) {
                    $is_manager = true;
                }
            }
        }

        return json_encode(['status' => ($ok ? 'ok' : 'error'), 'id' => $model->id, 'work_pos_span' => $work_pos_span, 'is_manager' => $is_manager]);
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'id' => 'required', //'id' -> for organogram!
        ]);
        $id = $request->get('id');
        $model = Models\Organogram::find($id);
        $ok = $this->_save($request, $model);

        return json_encode(['status' => $ok ? 'ok' : 'error']);
    }

    public function rename(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|max:255',
        ]);
        $id = $request->get('id');
        $name = $request->get('name');

        $model = Models\Organogram::find($id);
        $model->name = $name;
        $ok1 = $model->save();

        $ok2 = true;//DB::table('departments')->where('id', $model->entity_id)->update(['name' => $name]);

        $ok = $ok1 && $ok2;

        return json_encode(['status' => $ok ? 'ok' : 'error']);
    }

    public function delete(Request $request)
    {
        //die();
        $this->validate($request, [
            'id' => 'required',
            'type' => 'required|min:0|max:1', //0=employee 1=department
        ]);

        $id = $request->get('id');
        $type = $request->get('type');
        $ok = true;
        $organogram = Models\Organogram::find($id);
        switch ($type) {
            case '1': //department
                $ok = DB::table('departments')->where('id', $organogram->entity_id)->delete();
        }

        if ($ok) {
            $organogram->delete();
        }

        return json_encode(['status' => $ok ? 'ok' : 'error']);
    }

    //no action!!!!
    public function _save(Request $request, $model)
    {

        //$model -> is organogram

        //parent_id, zlib_dep_type_id, name
        $this->validate($request, [
            'parent_id' => 'required',
            'emp_id' => 'integer',
            'z__department_type_ids' => 'array|min:1',
            'z__lib_working_position_ids' => 'array|min:1',
            'position' => 'array|min:1',
            'name' => 'required|max:255',
            'type' => 'required|min:0|max:1', //0=employee 1=department
            'department_id' => 'integer',
        ]);

        $type = $request->get('type');
        $name = $request->get('name');
        $parent_id = $request->get('parent_id');

        switch ($type) {
            case '0': //employee
                $emp_id = $request->get('emp_id');
                $zlib_working_positions = $request->get('z__lib_working_position_ids');
                $department_id = $request->get('department_id');

                $zlib_working_position_str = "|".implode('|', $zlib_working_positions)."|";
                $model->entity_id = $emp_id;
                $model->z__lib_working_position_ids = $zlib_working_position_str;
                $model->z__department_type_ids = $department_id;
                break;
            case '1': //department
                $z__department_type_ids = $request->get('z__department_type_ids');
                $z__department_type_ids_str = "|".implode('|', $z__department_type_ids)."|";
                $depart_id = DB::table('departments')->insertGetId(['name' => $name]);
                $model->entity_id = $depart_id;
                $model->z__department_type_ids = $z__department_type_ids_str;

                break;
        }

        $model->parent_id = $parent_id;
        $model->name = $name;
        $model->type = $type;

        return $model->save();
    }
}
