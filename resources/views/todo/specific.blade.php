@extends('app')


@section('title')



    <p>Progress: Completed {{$complete}}/{{$incomplete}} tasks</p>
    <div id="myProgress" style="width:100%; color:gray;">

        <div id="myBar" style="width:calc(({{$complete}}/{{$incomplete}})*100%); background-color:#bababa;color:transparent; border-radius: 6px;">Hi</div>
    </div>



@stop

@section('content')



    <div class="container" >
        <h2>Tasks for {{$date}} {{$number}}</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Task name</th>
            </tr>
            </thead>
            <tbody>
            @foreach($todos as $todo)
                <tr>

                    {{--<td><a href="{{action('TodoController@check',array('id'=>$todo->id,'date'=>$date))}}">{{  Form::checkbox('agree')}}</a></td>--}}

                    {{--<td><a href="{{action('TodoController@check',array('id'=>$todo->id,'date'=>$date))}}">{{  Form::checkbox('agree')}}</a></td>--}}
                    {{ Form::open(array("url"=>"/check"))}}
                    {{ Form::hidden('id', $todo->id) }}
                    <input type="hidden" name="agree" value="1" >
                    <td>{{  Form::checkbox('agree',1,$todo->checked ,['id' => 'ck','onChange'=>"this.form.submit()"]) }}</td>

                    {{ Form::close()}}




                    <td><span id="taskName">{{ $todo->task }}</span></td>
                    <td><form action="/todo/{{ $todo->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button class="btn btn-danger">Delete Task  <span class="glyphicon glyphicon-trash"></span></button>
                        </form></td>

                    <td><form method="POST" action="{{url('/avatars', [$todo->id])}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <label class="form-control-file " >
                            <input  type="file" name="avatar" class="filestyle" />
                            </label>

                            <br>

                            <button class="btn btn-success" type="submit">Save image</button>

                        </form></td>

                    <td>@if($todo->image) {{Html::image('images/'.$todo->image, "Choose your image", array( 'width' => 70, 'height' => 70 )) }}@endif</td>

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <script>

        $(document).ready(function(){
            $('#ck').on('change', function(){
                $('#btn').submit();
            });

        });



    </script>
    <script src="js/navBar.js"></script>




@stop







