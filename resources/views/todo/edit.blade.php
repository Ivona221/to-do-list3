@extends('app')


@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))


@section('content')
    <h2>Edit task {{$todo->task}}</h2>

    <form action="{{ url('edit')}}" method="POST" class="form-horizontal" id="ajax">
        {{ csrf_field() }}

        <input type="hidden" name="_token" value="{{ csrf_token() }}">



        <!-- Task Name -->
        <div class="form-group">
            <label for="task-name" class="col-sm-3 control-label">Task</label>

            <div class="col-sm-6">
                <input type="text" name="task" id="task-name" class="form-control" value="{{$todo->task}}">
                <label>Pick start date and time</label>
                <br>
                <input type="date" name="start_date" id="start_date" value="{{$now}}">

                <input type="time" name="start_time" id="start_time" value="{{$nowTime}}">
                <label>Pick end date and time</label>
                <br>
                <input type="date" name="end_date" id="end_date" value="{{$now}}">
                <input type="time" name="end_time" id="end_time" value="{{$nowTime}}">
                <br>
                <label>Choose the type of the task</label>

                <input type="hidden" name="user_id" value="{{ $usrId}}" id="usrId">

                <select type="text"  id="select"  class="form-control" >

                    <option value="work">Work</option>
                    <option value="school">School</option>
                    <option value="home">Home</option>
                    <option value="free_time">Free Time</option>
                </select>

                <input type="hidden" value="" name="type" id="hiddenSelect">

                <input id="date" type="hidden" name="date" value={{$date}}>

                <input type="hidden" value="{{$todo->id}}" name="todoId">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">



            </div>
        </div>
        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default" id="submit">
                    <i class="fa fa-btn fa-plus"></i>Update Task
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
        $("#select").on('change',function() {
            $('#hiddenSelect').val($('#select').val());
        });
    </script>

    @stop