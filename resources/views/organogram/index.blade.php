<style>
    .work-pos {
        font-size: 12px;
        font-style: italic;
    }


    .jstree-node.is-manager .glyphicon-user {
        color: #f00;
    }


    .glyphicon .glyphicon-user,
    .user-manager {
        color: #f00;
    }


</style>


<?php

$path = base_path().'/resources/views/organogram/context-js';
$context_organogram_type = $department == null ? $path.'/department'.'.js' : $path.'/employee'.'.js'; // name of file to include

?>

@include('layouts.head')
@include('organogram._modals')


<link rel = "stylesheet" href = "{{url('/')}}/assets/jstree/dist/themes/default/style.min.css"/>


<div id = "jstree"></div>
<br/>
<br/>
<br/>


<script>
    $(document).ready(function () {

        var create_employee = "{{Lang::get('organogram.create_employee')}}";
        var view_item = "{{Lang::get('organogram.view_item')}}";

        var first_time = true;

        <?php if (isset($department) && $department > 0) echo 'var department_id = '.$department.';'; ?>
        //var department_id = {{ $department }};
        //alert(department_id);
        var tree = [
            {"id": "1", "parent": "#", "text": "Simple root node", "data": {'z__department_type_ids': 2}},
            {"id": "2", "parent": "#", "text": "Root node 2"},
            {"id": "3", "parent": "2", "text": "Child 1", "data": {'z__department_type_ids': 1}},
            {"id": "4", "parent": "2", "text": "Child 2"},
        ];


        // create, update, delete
        function sendDataServer(data, action, callback) {
            //console.log('data:', data);
            var actions = {
                create: '{{ url('organogram/create') }}',
                update: '{{ url('organogram/update') }}',
                delete: '{{ url('organogram/delete') }}',
                rename: '{{ url('organogram/rename') }}'
            };
            $.ajax({
                url: actions[action],
                type: "POST",
                //dataType: "json",
                headers: {'X-CSRF-TOKEN': '{{ @csrf_token() }}'},
                data: data,
                success: function (data) {
                    var data = JSON.parse(data);
                    //console.log(data);
                    if (data.status == 'ok') {
                        callback(data);
                    } else {
                        //console.log('Something error');
                    }
                },
                fail: function (error) {
                    console.log(error);
                }
            });


        };

        $('#jstree').jstree({
            'core': {
                "animation": 0,
                "check_callback": true,
                "themes": {
                    // "stripes": true,
                    "variant": "medium"
                },
                'data': @php echo json_encode($data); @endphp,
            },
            'data': function (node) {
                //console.log('init:' + node.id);
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
                    "icon": "glyphicon glyphicon-th",
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
            ],
            "contextmenu": {
                "items": function () {
                    <?php
                    //@includeWhen((true), 'organogram.context-js.' . $context_organogram_type)
                    include $context_organogram_type;
                    ?>
                }
            },
            "sort": function (a, b) {

                if (!first_time) {
                    return 1;
                }

                var n1 = this.get_node(a);
                var n2 = this.get_node(b);

                //console.log('sorting...' + first_time);
                //console.log('sorting 1...', n1.data);
                //console.log('sorting 2...', n1.data.is_manager);
                //console.log('sorting' , this, n1,n2);

                return n1.data !== null ? (n1.data.is_manager == null ? 1 : (n1.data.is_manager == true ? -1 : (n2.data.is_manager == true ? 1 : -1))) : -1;

                /*
                if (a1.icon == b1.icon) {
                    return (a1.text > b1.text) ? 1 : -1;
                } else {
                    return (a1.icon > b1.icon) ? 1 : -1;
                }*/
            }
        });


        // arrangeNodes();
        // 6 create an instance when the DOM is ready
        // $('#jstree').jstree();
        // 7 bind to events triggered on the tree


        $("#jstree").bind('ready.jstree', function (event, data) {
            //console.log('ready.jstree');
            first_time = false;
            var $tree = $(this);

            $($tree.jstree().get_json($tree, {
                flat: true
            }))
                .each(function (index, value) {
                    //var node = $tree.jstree().get_node(this.id);
                    //nod.id
                    var $node = $tree.find('#' + this.id);
                    //console.log('all data:', this.data);
                    //console.log($node.get(0));
                    //data-*
                    $node.attr('data-type', this.data.type);
                    $node.attr('data-is-manager', this.data.is_manager);
                    //$node.attr('data-model',  JSON.stringify(this.data));
                    if (this.data.type == 0) {
                        $node.find('a i').addClass('glyphicon-user').removeClass('glyphicon-th');
                    }
                    if (this.data.is_manager == true) {
                        $node.addClass('is-manager');
                    }


                    // if ($('div').hasClass('jstree-anchor')) {
                    //     // console.log('this.status.is_manager', this.status.is_manager);
                    //     // console.log('node.find', $node, 'data -->', data)
                    //     // $node.addClass('is-manager2');
                    //     alert('jstree-anchor');
                    // }

                    // if ($node.find('a i').hasClass('user-manager')) {
                    //     // console.log('this.status.is_manager', this.status.is_manager);
                    //     console.log('node.find', $node, 'data -->', data)
                    //     $node.addClass('is-manager');
                    // }


                });


            $("#jstree").jstree("open_all");

        });


        $("#jstree").on("after_open.jstree", function (e, data) {
            //console.log('after_open.jstree');
            $("#jstree").trigger('ready.jstree');
        });


        $('#jstree').on("changed.jstree", function (e, data) {
            // data.node.is_deleted =0;
            //console.log('changed.jstree -> ' + data.selected);
        });


        $('#jstree').on("create_node.jstree", function (e, data) {
            //console.log('create_node.jstree', data);
            var node_type = data.node.original.node_type;
            //console.log(data.node.original.node_type);
            // data.node.is_deleted =0;

            switch (node_type) {
                case 'department':
                    break;
                case 'employee':
                    break;
            }
            //console.log('create:' + data.selected, e, data);
            //console.log('type:' + node_type);
        });

        $('#jstree').on("rename_node.jstree", function (e, data) {

            setTimeout(function () {
                //console.log('rename_node.jstree:', data);
                var dataTo = {id: data.node.id, name: data.node.text};
                sendDataServer(dataTo, 'rename', function (results) {
                });
                $("#jstree").trigger('ready.jstree');
            }, 1000);

            setTimeout(function () {
                $("#jstree").trigger('ready.jstree');
            }, 1000);


        });

        // 8 interact with the tree - either way is OK
        $('button').on('click', function () {
            //console.log('click.jstree');
            $('#jstree').jstree(true).select_node('child_node_1');
            $('#jstree').jstree('select_node', 'child_node_1');
            $.jstree.reference('#jstree').select_node('child_node_1');
        });

    });
</script>


@include('layouts.footer-js')
