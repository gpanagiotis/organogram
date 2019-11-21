<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>jsTree test</title>
    <!-- 2 load the theme CSS file -->
    <link rel="stylesheet" href="dist/themes/default/style.min.css"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>


    <style>

        .jstree-leaf > .jstree-anchor > .jstree-themeicon:before {
            content: "\e008";
            /*.glyphicon-user;*/
        }

        .jstree-anchor > .jstree-themeicon:before {

            /*content: "";*/
            /*  \e074  */

        }

        /*set arrow head at the right of leaf*/

        /*.jstree-leaf:after {*/
        /*!*content: "\e072";*!*/
        /*!*position: absolute;*!*/
        /*!*right: 0;*!*/
        /*}*/
    </style>

</head>
<body>
<!-- 3 setup a container element -->
<div id="jstree">
    <!-- in this example the tree is populated from inline HTML -->
    <!--    <ul>-->
    <!--        <li>Root node 1-->
    <!--            <ul>-->
    <!--                <li id="child_node_1">Child node 1</li>-->
    <!--                <li>Child node 2</li>-->
    <!--            </ul>-->
    <!--        </li>-->
    <!--        <li>Root node 2</li>-->
    <!--    </ul>-->
</div>


<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-tree-type">Open Modal</button>
<button type="button" class="btn btn-info btn-lg open-tree-type-button" data-toggle="modal">Open Tree type</button>


<!-- Modal -->
<div class="modal fade" id="modal-tree-type" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Enter the type of node</p>
                <select class="selection-tree-type">
                    <option value="0">Employee</option>
                    <option value="1">Manager</option>
                    <option value="2">Departement</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-default ok-tree-type-button" data-dismiss="modal">Ok</button>
            </div>
        </div>

    </div>
</div>

<!-- 4 include the jQuery library -->
<!--<script src="dist/libs/jquery.js"></script>-->
<!-- 5 include the minified jstree source -->
<script src="dist/jstree.min.js"></script>
<script>
    $(document).ready(function () {


        // $('.open-tree-type-button').click(function(){
        //     $('#modal-tree-type').modal('show');
        // });
        //
        // $('.ok-tree-type-button').click(function(){
        //    var o = $('#modal-tree-type .selection-tree-type').val();
        //    alert(o);
        // });


        //$('#modal-tree-type').modal('show');

        // $(" .jstree-leaf > .jstree-anchor > .jstree-themeicon:before").addClass("glyphicon glyphicon-book");


        var tree = [
            {"id": "1", "parent": "#", "text": "Simple root node"},
            {"id": "2", "parent": "#", "text": "Root node 2"},
            {"id": "3", "parent": "2", "text": "Child 1"},
            {"id": "4", "parent": "2", "text": "Child 2"},
        ]


        //$.ajax.success(data);
        function getAjaxTree(callBack) {
            $.ajax({
                url: "fetch.php",
                method: "POST",
                dataType: "json",
                success: function (data) {
                    //setTimeout(function(){callBack(data);},3000);
                    callBack(data);
                }
            });
        }


        getAjaxTree(function (data) {
            //console.log(data);
            $('#jstree').jstree({

                'core': {
                    "animation": 0,
                    "check_callback": true,
                    "themes": {
                        // "stripes": true,
                        "variant": "medium"
                    },
                    'data': data
                },
                'data': function (node) {
                    console.log('init:' + node.id);
                    return {'id': node.id};
                },

                "types": {
                    "#": {
                        // "max_children" : 1,
                        // "max_depth" : 4,
                        "icon": "glyphicon glyphicon-th",
                        "valid_children": ["root"]
                    },
                    "root": {
                        "icon": "/glyphicon glyphicon-book",
                        "valid_children": ["default"]
                    },
                    "default": {
                        "icon": "glyphicon  glyphicon-th", //glyphicon-book glyphicon-user glyphicon-th glyphicon-stop
                        "valid_children": ["default", "file"]
                    },
                    "file": {
                        "icon": "glyphicon glyphicon-user",
                        "valid_children": []
                    },
                },


                "plugins": [
                    // "checkbox",
                    "contextmenu",
                    "dnd",
                    "massload",
                    "search",
                    "sort",
                    "state",
                    "types",
                    "unique",
                    "wholerow",
                    "changed",
                    "conditionalselect"
                ]


            });

        });


        // 6 create an instance when the DOM is ready
        // $('#jstree').jstree();
        // 7 bind to events triggered on the tree
        $('#jstree').on("changed.jstree", function (e, data) {
            console.log('changed:' + data.selected);
        });

        $('#jstree').on("create_node.jstree", function (e, data) {
            console.log('create:' + data.selected, e, data);
        });

        $('#jstree').on("rename_node.jstree", function (e, data) {


            $('#modal-tree-type').modal('show');
            $('.ok-tree-type-button').one('click', function () {
                var o = $('#modal-tree-type .selection-tree-type').val();
                data.node.tree_type = o;
                sendDataServer(data);

            });


            function sendDataServer(data) {
                console.log(e, data);
                //console.log('data:', data.node);

                var node = data.node;
                var info = {'id': node.id, 'name': node.text, 'parent_id': node.parent, tree_type: node.tree_type };
                //console.log('rename:',  data.node);
                //console.log('info', JSON.stringify(info));
                console.log('data:', info);

                $.ajax({
                    url: "create-node.php",
                    method: "POST",
                    dataType: "json",
                    data: info, //task:'delete'
                    success: function (data) {
                        //data: {status:'ok', new_id:1345} OR  {status:'error', message:'Database error'}
                        if (data.status == 'ok') {
                            //node.id = data.new_id;
                            $('#jstree').jstree(true).set_id(node, data.new_id);
                            $('#jstree').jstree(true).set_icon(node, "glyphicon glyphicon-user");
                        } else {
                            alert(data.message);
                        }
                    }
                });
            }
        });

        // 8 interact with the tree - either way is OK
        $('button').on('click', function () {
            $('#jstree').jstree(true).select_node('child_node_1');
            $('#jstree').jstree('select_node', 'child_node_1');
            $.jstree.reference('#jstree').select_node('child_node_1');
        });


    });
</script>
</body>
</html>