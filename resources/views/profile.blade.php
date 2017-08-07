@extends('app')
@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))
@section('style')
    <style>
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    @stop
@section('content')
    <div>
        <form action="/image" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
    <img @if($user->avatar)src="images/{{$user->avatar}}" @else src="images/user.jpg" @endif width="200px" height="200px" style="border-radius: 50%; display:inline-block;">
        <h2 >{{$user->name}} <a id="myBtn"><span class="glyphicon glyphicon-pencil"></span></a></h2>
        <p>

            <input  type="file" name="avatar" />
            <input type="hidden" name="userId" value="{{$user->id}}">
            <br>
            <button class="btn btn-success" id="buttonUpdate" name="updateImage">Upload your profile image</button>
        </p>
        </form>
    </div>


    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="/updateimg" method="POST">
                {{csrf_field()}}
            <p>Enter your new username:</p>
            <input name="changedName" value="{{$user->name}}">
                <br>
                <br>
                <button class="btn btn-success" type="submit">Change your username</button>
            </form>
        </div>

    </div>
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@stop