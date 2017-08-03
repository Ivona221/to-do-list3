@extends('app')


@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))


@section('content')
    <h2>Edit event {{$occasion->name}}</h2>

    <form action="{{ url('/editOcc')}}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <!-- Task Name -->
        <div class="form-group">


            <div class="col-sm-6">
                <label for="occasion-name" >Event</label>


                <input type="text" name="name" id="occasion-name" class="form-control" value="{{$name}}">
                <label for="occasion-place" >Place</label>

                <input type="text" name="place" id="occasion-place" class="form-control" value="{{$place}}">
                <label for="occasion-date" >Date</label>

                <input type="date" name="date" id="occasion-date" class="form-control" value="{{$date}}">


                <label for="occasion-time">Time</label>

                <input type="time" name="time" id="occasion-time" class="form-control" value="{{$time}}">


                <label for="participants">Choose participants</label>
                {!! Form::select('users[]',[$users],$occasion->usersList(),['id'=>'users_list','class'=>'form-control','multiple']) !!}
                <input type="hidden" name="organizer_id" value="{{$organizer_id}}">

                <input type="hidden" name="eventId" value="{{$id}}">



            </div>
        </div>

        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-btn fa-plus"></i>Update Event
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
        $('#users_list').select2({
            placeholder:'Choose Participants'


        });
    </script>

@stop