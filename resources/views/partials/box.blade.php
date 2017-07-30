<div class="container">



    <div class="col-sm-offset-2 col-sm-8 ">
        <div class="panel panel-default bg-info">
            <div class="panel-heading bg-warning" >

                DATE-{{ $date }} {{ date("D", strtotime($date))}}



                <a id="spesView" href="{{action('TodoController@show',array('date'=>$date))}}"> <button  class="btn btn-sm btn-default pull-right" >&#187;</button></a>
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->


                <!-- New Task Form -->
                <form action="{{ url('todoAdd')}}" method="POST" class="form-horizontal" id="ajax">
                {{ csrf_field() }}

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">



                <!-- Task Name -->
                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">Task</label>

                        <div class="col-sm-6">
                            <input type="text" name="task" id="task-name" class="form-control" value="">
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

                            <select type="text"  id="select"  class="form-control">

                                <option value="work">Work</option>
                                <option value="school">School</option>
                                <option value="home">Home</option>
                                <option value="free_time">Free Time</option>
                            </select>

                            <input type="hidden" value="" name="type" id="hiddenSelect">

                            <input id="date" type="hidden" name="date" value={{$date}}>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">

                            <ul id="todoList">
                                @foreach($todos as $td)
                                    <a style="text-decoration: none;"
                                       href="{{action('TodoController@update2',
                                       array('id'=>$td->id))}}"><li @if($td->checked==1)style="text-decoration: line-through;"
                                                                    @else style="text-decoration: none;" @endif onclick="this.style.textDecoration='line-through'"
                                                                    class="list-group-item  list-group-item-success " id="list"><span  class="glyphicon glyphicon-menu-right" >

                                            </span> {{$td->task}}</li></a>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default" id="submit">
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

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<script>
    $("#select").on('change',function() {
        $('#hiddenSelect').val($('#select').val());
    });

    /*$(document).ready(function() {
        $('#submit').on('submit', function (e) {
            e.preventDefault();
            var task = $('#task-name').val();
            var startDate=$('#start_date');
            var endDate=$('#end_date');
            var startTime=$('#start_time');
            var endTime=$('#end_time').val();
            var type=$('#hiddenSelect').val();
            var usrId=$('#usrId').val();
            var date=$('#date').val();

            $.ajax({
                type: "POST",
                url:  '/todoAdd',
                data: {task: task, start_date: startDate, start_time: startTime,
                    end_date:endDate,end_time:endTime,type:type,user_id:usrId,date:date},
                success: function( data ) {
                    $('#ajaxResponse').empty();
                    $("#ajaxResponse").html("<div>"+data.msg+"</div>");
                }
            })
                .done(function(data) {
                    console.log(data);
                });
            //just to be sure its not submiting form
            return false;
        });
    });*/

    /*$(document).ready(function() {

        var url = "http://127.0.0.1:8000/todoAdd";

        $("#btn-save").click(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
            e.preventDefault();
            var formData = {
                 task : $('#task-name').val();
             startDate:$('#start_date').val();
            endDate:$('#end_date').val();
            startTime:$('#start_time').val();
            endTime:$('#end_time').val();
            type:$('#hiddenSelect').val();
            usrId:$('#usrId').val();
            date:$('#date').val();
            }
            //used to determine the http verb to use [add=POST], [update=PUT]
            var state = $('#submit').val();
            var type = "POST"; //for creating new resource
            var my_url = url;

            console.log(formData);
            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    var product = '<tr id="product' + data.id + '"><td>' + data.id + '</td><td>' + data.task + '</td><td>' + data.type + '</td>';
                    product += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '">Edit</button>';
                    product += ' <button class="btn btn-danger btn-delete delete-product" value="' + data.id + '">Delete</button></td></tr>';
                    //if user added a new record
                        $('#todoList').append(product);



                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
*/








</script>

