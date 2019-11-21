var r = {"Create_depart": {
"label": "Create Department",
"action": function (treeData) {
var ref = $.jstree.reference(treeData.reference);
$("#modal-tree-dep").modal("show");
$(".ok-tree-dep-button").one("click", function () {
sel = ref.get_selected();
if (!sel.length) {
return false;
}
sel = sel[0];
sel = ref.create_node(sel, {"type": "file", "node_type": "department"});
var node = $("#jstree").jstree(true).get_node(sel, false);


var z__department_type_ids = $("#modal-tree-dep .selection-lib-id").val();
//alert (lib_dep_type_id);
var name = $("#modal-tree-dep .node-name").val();
var data = {};
//var toSend = {"id": data.id, "name": data.text, "parent_id": data.parent, "tree_type": data.tree_type};


data.name = name;
data.parent_id = node.parent;
data.type = 1; //1=department
data.z__department_type_ids = z__department_type_ids;
console.log(data);
console.log("--node-->", node);
sendDataServer(data, 'create', function (results) {
//console.log(node);
//alert(name);
$("#jstree").jstree("rename_node", node, name);
$("#jstree").jstree(true).set_id(node, results.id);
$("#jstree").jstree(true).set_icon(node, "glyphicon glyphicon-th");
});
});

}
},
"Rename_item": {
"label": "Rename",
"action": function (data) {
var inst = $.jstree.reference(data.reference);
obj = inst.get_node(data.reference);
inst.edit(obj);
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
data.type = 1;

sendDataServer(data, 'delete', function (results) {
ref.delete_node(sel);
});
});

}
}
,};

return r;
