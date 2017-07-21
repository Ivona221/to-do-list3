
<div class="container">


    <div class="col-sm-offset-2 col-sm-8 ">
        <div class="panel panel-default bg-info">
            <div class="panel-heading bg-warning" >
                DATE-{{ $date }} {{ date("D", strtotime($date))}}  {{\Carbon\Carbon::now()->addMinute(5)->format('H:i')}}
                <a href="{{action('TodoController@show',array('date'=>$date))}}"> <button  class="btn btn-sm btn-default pull-right" >&#187;</button></a>
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->


                <!-- New Task Form -->
                <form action="{{ url('\todoAdd')}}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- Task Name -->
                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">Task</label>

                        <div class="col-sm-6">
                            <input type="text" name="task" id="task-name" class="form-control" value="">
                            <label>Pick start date and time</label>
                            <br>
                            <input type="date" name="start_date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                            <input type="time" name="start_time" value="{{\Carbon\Carbon::now()->format('H:i')}}">
                            <label>Pick end date and time</label>
                            <br>
                            <input type="date" name="end_date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                            <input type="time" name="end_time" value="{{\Carbon\Carbon::now()->format('H:i')}}">

                            <select type="text"  id="select"  >
                                <option value="work">Work</option>
                                <option value="school">School</option>
                                <option value="home">Home</option>
                                <option value="free_time">Free Time</option>
                            </select>

                            <input type="hidden" value="" name="type" id="hiddenSelect">

                            <input type="hidden" name="date" value={{$date}}>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">

                            <ul>
                                @foreach(\App\Todo::where(['date'=>$date,'user_id'=>Auth::user()->id])->get() as $td)
                                    <li class="list-group-item @if($td->id%2==0) list-group-item-success @else list-group-item-warning @endelse @endif "><span class="glyphicon glyphicon-menu-right"></span> {{$td->task}}</li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>Add Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $("#select").on('change',function() {
        $('#hiddenSelect').val($('#select').val());
    });
</script>

