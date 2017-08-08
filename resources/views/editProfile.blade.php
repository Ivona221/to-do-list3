@extends('app')


@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))


@section('content')
    <h2>Edit profile {{$user->name}}</h2>

    <form action="{{ url('updateimg')}}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <!-- Task Name -->
        <div class="form-group">
            <div class="col-sm-6">
                <label>Name</label>
                <br>
                <input type="text" name="name" id="name" class="form-control" value="{{$user->task}}">
                <label>Email</label>
                <br>
                <input type="text" name="email" id="email" value="{{$user->email}}">
            </div>
        </div>

        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default" id="submit">
                    <i class="fa fa-btn fa-plus"></i>Update Profile
                </button>
            </div>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="http://code.jquery.com/jquery.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        $("#select").on('change', function () {
            $('#hiddenSelect').val($('#select').val());
        });
    </script>

@stop