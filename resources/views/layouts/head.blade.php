<meta charset = "utf-8">
<meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name = "description" content = "">
<meta name = "author" content = "">
<link rel = "shortcut icon" href = "favicon.ico" type = "image/x-icon">

<title>{{Lang::get('env.app_title')}}</title>


<!-- bootstrap -->
{{--<link rel = "stylesheet" href = "ht tps://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">--}}
<link rel = "stylesheet" href = "{{ url('/') }}/libs/bootstrap.min.css">

<!-- jQuery library -->
{{--<script src = "ht tps://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
<script src = "{{ url('/') }}/libs/jquery.min.js"></script>


<!-- Latest compiled JavaScript -->
{{--<script src = "ht tps://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>--}}
<script src = "{{ url('/') }}/libs/bootstrap.min.js"></script>


{{--select 2--}}
{{--<link rel = "stylesheet" href = "ht tps://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css"/>--}}
<link rel = "stylesheet" href = "{{ url('/') }}/libs/select2.css"/>
{{--select 2 bootsrap beta--}}
{{--<link rel = "stylesheet" href = "ht tps://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css"/>--}}
<link rel = "stylesheet" href = "{{ url('/') }}/libs/select2-bootstrap.css"/>



<nav class = "navbar navbar-default">
    <div class = "container-fluid">
        <div class = "navbar-header">
            <a class = "navbar-brand" href = "{{url("/")}}">Organogram</a>
        </div>
        <ul class = "nav navbar-nav">
            <li><a href = "{{url("/organogram")}}">Create Departments</a></li>
            <li><a href = "{{url("/organogram/1")}}">Insert Employees</a></li>
        </ul>
    </div>
</nav>


