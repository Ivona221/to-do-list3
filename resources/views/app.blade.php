
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ Illuminate\Support\Facades\URL::asset('css/main.css') }}">

    @yield('style')

</head>
<body style="overflow-x:hidden;">


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
                            <a >@yield('title')</a>
                        </li>
                        <li>
                            <a href="/home">Home</a>
                        </li>
                        <li>
                            <a href="/todo">Next 7 days</a>
                        </li>
                        <li>
                            <a href="#">Today</a>
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
                                <li><a href="{{action('TodoController@show3',array('type'=>"all"))}}"  class="search" id="all"> <span class="glyphicon glyphicon-list-alt"  ></span> All Tasks @yield('completedAll')</a></li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"home"))}}"  class="search" id="home"><span class="glyphicon glyphicon-home"  ></span> Home</a></li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"school"))}}" class="search" id="school"><span class="glyphicon glyphicon-education" ></span> School</a></li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"work"))}}" class="search" id="work"><span class="glyphicon glyphicon-lock" ></span> Work</a></li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"free_time"))}}"  class="search" id="free_time"><span class="glyphicon glyphicon-knight"  ></span> Free time</a></li>
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

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script >$(document).ready(function () {
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
    });</script>



@yield('footer')

</body>
</html>