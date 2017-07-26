<!DOCTYPE html>
<html>

<head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ Illuminate\Support\Facades\URL::asset('css/main.css') }}">

</head>

<body>



<div id="wrapper">


    <nav class="navbar navbar-inverse ">
        <div class="container-fluid">
            <div class="navbar-header">



                <!-- Sidebar -->
                <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                    <ul class="nav sidebar-nav">
                        <li class="sidebar-brand">
                            <a href="#">
                                Brand
                            </a>
                        </li>
                        <li>
                            <a><p>Progress: Completed {{$complete}}/{{$incomplete}} tasks</p>

                                <div id="myProgress" style="width:100%;" >

                                    <div id="myBar" style="width:calc(({{$complete}}/{{$incomplete}})*100%); background-color:#bababa;color:transparent; border-radius: 6px;">Hi</div>
                                </div></a>
                        </li>
                        <li>
                            <a href="/home">Home</a>
                        </li>
                        <li>
                            <a href="/todo">Next 7 days</a>
                        </li>

                        <li>
                            <a href="/events">Calendar</a>
                        </li>
                        <li>
                            <a href="/event">Add Events</a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-header">Filter By Type</li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"all"))}}"  class="search" id="all"> <span class="glyphicon glyphicon-list-alt"  ></span> All Tasks  <span>{{ $notcomplete }}</span></a></li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"home"))}}"  class="search" id="home"><span class="glyphicon glyphicon-home"  ></span> Home  <span>{{ $notcompleteHome }}</span></a></li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"school"))}}" class="search" id="school"><span class="glyphicon glyphicon-education" ></span> School  <span>{{ $notcompleteSchool }}</span></a></li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"work"))}}" class="search" id="work"><span class="glyphicon glyphicon-lock" ></span> Work  <span>{{ $notcompleteWork }}</span></a></li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"free_time"))}}"  class="search" id="free_time"><span class="glyphicon glyphicon-knight"  ></span> Free time  <span>{{ $notcompleteFreeTime }}</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/stats">Statistics</a>
                        </li>


                    </ul>
                </nav>
                <!-- /#sidebar-wrapper -->


                <a class="navbar-brand" href="#">&nbsp;&nbsp;&nbsp;<button   type="button" class="hamburger is-closed" data-toggle="offcanvas">
                        <span  class="hamb-top"></span>
                        <span class="hamb-middle"></span>
                        <span class="hamb-bottom"></span>
                    </button></a>
            </div>
            <ul class="nav navbar-nav">
                <li ><a href="/home">Name of the website</a></li>





            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href=""><span class="glyphicon glyphicon-user"></span> {{Auth::user()->name}}</a></li>
                <li><a href="/register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>


    </nav>


    <div class="container" style="margin-top:100px;">

        @yield('content')
    </div>



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
</div>

<script>
    $(document).ready(function () {
        var trigger = $('.hamburger'),
            overlay = $('.overlay'),
            isClosed = false;

        trigger.click(function () {
            hamburger_cross();
        });

        function hamburger_cross() {

            if (isClosed == true) {
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
            } else {
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
            }
        }

        $('[data-toggle="offcanvas"]').click(function () {
            $('#wrapper').toggleClass('toggled');
        });
    });
</script>
</body>

</html>