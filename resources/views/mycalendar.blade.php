

<!doctype html>

<html lang="en">

<head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>


<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">





            <a class="navbar-brand" href="#">Name</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/home">Home</a></li>

            <li><a href="/todo">To-Do</a></li>
            <li><a href="/event">Add Events</a></li>



            <li><a href="/stats">Statistics</a></li>
            <li><a href="/events">Calendar</a></li>
            <li><div class="dropdown">
                    <button style="margin:8px; background-color:transparent; color:gainsboro; border:0px solid transparent;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Types
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{action('TodoController@show3',array('type'=>"all"))}}"  class="search" id="all"> <span class="glyphicon glyphicon-list-alt"  ></span> All Tasks</a></li>
                        <li><a href="{{action('TodoController@show3',array('type'=>"home"))}}"  class="search" id="home"><span class="glyphicon glyphicon-home"  ></span> Home</a></li>
                        <li> <a href="{{action('TodoController@show3',array('type'=>"school"))}}" class="search" id="school"><span class="glyphicon glyphicon-education" ></span> School</a></li>
                        <li>  <a href="{{action('TodoController@show3',array('type'=>"free_time"))}}"  class="search" id="free_time"><span class="glyphicon glyphicon-knight"  ></span> Free time</a></li>
                    </ul>
                </div></li>


        </ul>
        <ul class="nav navbar-nav navbar-right">



        </ul>
        <ul class="nav navbar-nav navbar-right">


            <li><a href=""><span class="glyphicon glyphicon-user"></span> {{Auth::user()->name}}</a></li>
            <li><a href="/register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>


</nav>

<div class="container">

    <div class="panel panel-primary">

        <div class="panel-heading">

            MY Calender

        </div>

        <div class="panel-body" >

            {!! $calendar->calendar() !!}

            {!! $calendar->script() !!}

        </div>

    </div>

</div>

</body>

</html>