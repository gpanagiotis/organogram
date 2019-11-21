var r = {
    "Create_empl": {
        "label": "Create Employee",
        "action": function (treeData) {
            var ref = $.jstree.reference(treeData.reference);
            $("#modal-tree-emp").modal("show");
            $(".ok-tree-emp-button").one("click", function () {
                var sel = ref.get_selected();
                if (!sel.length) {
                    return false;
                }
                sel = sel[0];
                sel = ref.create_node(sel, {"type": "file", "node_type": "employee"});
                var node = $("#jstree").jstree(true).get_node(sel, false);
                console.log("--node-->", node);

                var z__lib_working_position_ids = $("#modal-tree-emp .selection-lib-id").val();
                var name = $("#modal-tree-emp .selection-emp-name option:selected").text();
                var emp_id = $("#modal-tree-emp .selection-emp-name").val();
                var data = {};
                //var toSend = {"id": data.id, "name": data.text, "parent_id": data.parent, "tree_type": data.tree_type};

                data.name = name;
                data.parent_id = node.parent;
                data.type = 0; //0=employee
                data.z__lib_working_position_ids = z__lib_working_position_ids;
                data.emp_id = emp_id;
                data.department_id = department_id;

                //console.log("z__lib_working_position_ids -> ",z__lib_working_position_ids);
                console.log("name -> ", name);
                sendDataServer(data, 'create', function (results) {
                    $("#jstree").jstree(true).set_id(node, results.id);
                    var created_node = $("#jstree").jstree(true).get_node(results.id);
                    created_node.data = {};
                    created_node.data.entity_id = data.emp_id;
                    created_node.data.is_manager = results.is_manager;
                    created_node.data.type = 0; //person

                    // $("#jstree").jstree("rename_node", node, name);
                    $("#jstree").jstree("set_text", node, name + results.work_pos_span);

                    // if (results.is_manager == true) {
                    //     $("#jstree").jstree(true).set_icon(node, "glyphicon glyphicon-user user-manager");
                    // } else {
                    //     $("#jstree").jstree(true).set_icon(node, "glyphicon glyphicon-user");
                    // }
                    setTimeout(function () {
                        $("#jstree").trigger('ready.jstree');
                    }, 500);


                });
            });
        }
    }
    ,


    "view_item": {
        "label": "View Item",
        "action": function (treeData) {
            var ref = $.jstree.reference(treeData.reference);
            sel = ref.get_selected();
            var node = $('#jstree').jstree(true).get_node(sel, false);
            console.log('---node.entity_id--->', node.entity_id);
            window.open('/employee/view/' + node.data.entity_id + '/info', '_blank');
        }
    }
    ,


    "Delete_item": {
        "label": "Delete",
        "action": function (treeData) {
            var ref = $.jstree.reference(treeData.reference);
            $('#modal-tree-del').modal('show');
            $('.ok-tree-del-button').one('click', function () {
                sel = ref.get_selected();
                if (!sel.length) {
                    return false;
                }

                var node = $('#jstree').jstree(true).get_node(sel, false);

                console.log('---node_id--->' + node.id);

                var data = {};
                data.id = node.id;
                data.type = 0;

                sendDataServer(data, 'delete', function (results) {
                    ref.delete_node(sel);
                    setTimeout(function () {
                        $("#jstree").trigger('ready.jstree');
                    }, 500);

                });
            });


        }
    }
    ,
};

return r;
