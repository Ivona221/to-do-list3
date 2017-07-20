
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    @yield('style')
    <style>

    </style>
</head>
<body >


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
        </ul>
        <ul class="nav navbar-nav navbar-right">

            <li><a href=""><span class="glyphicon glyphicon-user"></span> {{Auth::user()->name}}</a></li>
            <li><a href="/register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
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

@yield('footer')

</body>
</html>