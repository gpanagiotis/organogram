<?php
use Illuminate\Support\Facades\DB;

$department_id = Request::route('department');
$departmentTypes = DB::table('z__lib_department_types')->pluck('title', 'id')->toArray();

$q = "SELECT `id`,`title` FROM z__lib_working_positions" .
    //" WHERE id in (SELECT table2_id FROM z__rel_organogram WHERE table1_id = " . (int)$department_id . " ) " .
    " ORDER BY `title`";

$employeeTypes = DB::select(DB::raw($q));
$tmp = [];
foreach ($employeeTypes as $v) {
    $tmp[$v->id] = $v->title;
}
$employeeTypes = $tmp;


$employees = DB::select(DB::raw("select CONCAT(last_name,' ',first_name) AS name,id from employees order by last_name, first_name"));//->pluck('name', 'id'); //->toArray();
$tmp = [];
foreach ($employees as $v) {
    $tmp[$v->id] = $v->name;
}
$employees = $tmp;

//dd($employees);


//$q = "SELECT `id`,`first_name`,`last_name` FROM `employees`" .
//    " ORDER BY `first_name`,`last_name`";


?>

<!-- Modal -->
<div class="modal fade" id="modal-tree-dep" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Insert Department</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="selection-lib-id"
                           class="control-label"><?php echo 'Επιλέξτε τμήμα'; ?></label>
                    <div class="">
                        <div class='input-group  col-md-12'>
                            <select class="selection-lib-id form-control" multiple>
                                @php foreach ($departmentTypes as $k => $v): @endphp
                                <option value="{{ $k }}">{{ $v }}</option>
                                @php endforeach; @endphp
                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="dep_name" class="control-label">Enter the Name</label>
                    <div class="">
                        <input type="text" class="node-name form-control" id="dep_name">
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-default ok-tree-dep-button" data-dismiss="modal">Ok</button>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="modal-tree-emp" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select employee</h4>
            </div>
            <div class="modal-body">
                <p>Enter the type of the employee</p>
                <select class="selection-lib-id form-control" multiple>
                    @php foreach ($employeeTypes as $k => $v): @endphp
                    <option value="{{ $k }}">{{ $v }}</option>
                    @php endforeach; @endphp
                </select>

                <p>Enter the employee</p>

                <select class="selection-emp-name node-name form-control">
                    @php foreach ($employees as $k => $v): @endphp
                    <option value="{{ $k }}">{{ $v }}</option>
                    @php endforeach; @endphp
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                </button>
                <button type="button" class="btn btn-default ok-tree-emp-button" data-dismiss="modal">Ok</button>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="modal-tree-del" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Enter your password to confirm deletion</p>
                <input class="password" type="password"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                </button>
                <button type="button" class="btn btn-default ok-tree-del-button" data-dismiss="modal">Ok</button>
            </div>
        </div>

    </div>
</div>
