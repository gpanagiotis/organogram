<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>js tree</title>
    <meta name="description" content="This is an example.">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="dist/themes/default/style.min.css"/>

</head>

<body>


<div id="jstree_demo_div"></div>


</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
<script src="dist/jstree.min.js"></script>

<script>
    $(document).ready(function () {

        // Create an instance
        $(function () {
            $('#jstree_demo_div').jstree();
        });

        // Listen for events
        $('#jstree_demo_div').on("changed.jstree", function (e, data) {
            console.log(data.selected);
        });


    });
</script>


</html>