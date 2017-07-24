
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>







    @yield('style')
    <style>


        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover, .offcanvas a:focus{
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }



        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }



    </style>
</head>
<body >


<div id="main">
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
            <li><a href=""><span class="glyphicon glyphicon-user"></span> {{Auth::user()->name}}</a></li>
            <li><a href="/register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>


</nav>




</div>



</nav>




@yield('title')



<div class="container" style="margin-top:100px;">
    @yield('content')
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script>




</script>



@yield('footer')

</body>
</html>