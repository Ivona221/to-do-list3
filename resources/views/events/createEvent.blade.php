@extends('app')
@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))
@section('content')



    <div class="container" >
        <div class="col-sm-offset-2 col-sm-8 ">
            <div class="panel panel-default bg-info">
                <div class="panel-heading bg-warning" >

                    Add a new Event

                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->


                    <!-- New Task Form -->
                    <form action="{{ url('/eventNew')}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                        <div class="form-group">


                            <div class="col-sm-6">
                                <label for="occasion-name" >Event</label>


                                <input type="text" name="name" id="occasion-name" class="form-control" value="">
                                <label for="occasion-place" >Place</label>

                                <input type="text" name="place" id="occasion-place" class="form-control" value="">
                                <label for="occasion-date" >Date</label>

                                <input type="date" name="date" id="occasion-date" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">


                                <label for="occasion-time">Time</label>

                                <input type="time" name="time" id="occasion-time" class="form-control" value="{{\Carbon\Carbon::now()->format('H:i')}}">

                                <label for="participants">Choose participants</label>
                                {!! Form::select('users[]',[$users],null,['id'=>'users_list','class'=>'form-control','multiple']) !!}
                                <input type="hidden" name="organizer_id" value="{{$organizer_id}}">



                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Create Event
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('#users_list').select2({
            placeholder:'Choose Participants',



        });
    </script>


@stop