<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ Illuminate\Support\Facades\URL::asset('css/main.css') }}">


    @yield('style')
    <style>
        .btn-custom {
            background-color: silver;
        }
    </style>
</head>
<body style="overflow-x:hidden;">

{{--<div>{{\Illuminate\Support\Facades\Auth::user()->subscribed('main')}}</div>--}}

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
                            <a>@yield('title')</a>
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

                        <li>
                            <a href="/eventCreate">Create an event</a>
                        </li>
                        <li>
                            <a href="/allOccasions">All events</a>
                        </li>
                        <li>
                            <a href="/subscription">Subscriptions</a>
                        </li>


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filters <span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-header">Filter By Type</li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"all"))}}" class="search"
                                       id="all"> <span class="glyphicon glyphicon-list-alt"></span> All
                                        Tasks @yield('completedAll')</a></li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"home"))}}" class="search"
                                       id="home"><span class="glyphicon glyphicon-home"></span>
                                        Home @yield('completedHome')</a></li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"school"))}}" class="search"
                                       id="school"><span class="glyphicon glyphicon-education"></span>
                                        School @yield('completedSchool')</a></li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"work"))}}" class="search"
                                       id="work"><span class="glyphicon glyphicon-lock"></span>
                                        Work @yield('completedWork')</a></li>
                                <li><a href="{{action('TodoController@show3',array('type'=>"free_time"))}}"
                                       class="search" id="free_time"><span class="glyphicon glyphicon-knight"></span>
                                        Free time @yield('completedFreeTime')</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Browse Threads <span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-header">Search threads</li>
                                <li><a href="/threads">All Threads</a></li>
                                @if (auth()->check())
                                    <li><a href="/threads?by={{ auth()->user()->name }}">My Threads</a></li>
                                @endif
                                <li><a href="/threads?popular=1">Popular Threads</a></li>
                                <li><a href="/threads?unanswered=1">Unanswered Threads</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="/threads/create">New Thread</a>
                        </li>

                        <li>
                            <a href="/stats">Statistics</a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Browse Channels <span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Search channels</li>
                                @foreach ($channels as $channel)
                                    <li><a href="/threads/{{ $channel->slug }}">{{ $channel->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>


                    </ul>
                </nav>
                <!-- /#sidebar-wrapper -->


                <a class="navbar-brand" href="#">&nbsp;&nbsp;&nbsp;<button type="button" class="hamburger is-closed"
                                                                           data-toggle="offcanvas">
                        <span class="hamb-top"></span>
                        <span class="hamb-middle"></span>
                        <span class="hamb-bottom"></span>
                    </button>
                </a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="/home">Name of the website</a></li>


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/profile"><img @if(Auth::user()->avatar)src="{{asset('images/'.Auth::user()->avatar)}}"
                                            @else src="{{asset('images/user.jpg')}}" @endif width="25px" height="25px"
                                            style="border-radius: 50%"> {{Auth::user()->name}}</a></li>
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

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>





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


@yield('footer')

</body>
</html>