@extends('app')

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
                    <form action="{{ url('\eventAdd')}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Event</label>

                            <div class="col-sm-6">
                                <input type="text" name="title" id="task-name" class="form-control" value="">
                                <input type="date" name="start_date" >
                                <input type="date" name="end_date" >

                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Event
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>





@stop
