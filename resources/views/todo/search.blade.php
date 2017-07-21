@extends('app')

@section('content')



    <div class="container" >
        <h2>Tasks for {{$date}} </h2>
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
                   {{ Form::open(array("url"=>"/check1"))}}
                    {{ Form::hidden('id', $todo->id) }}
                    <input type="hidden" name="agree" value="1" >
                    <td>{{  Form::checkbox('agree',1,App\Todo::where('id',$todo->id)->first()->checked ,['id' => 'ck','onChange'=>"this.form.submit()"]) }}</td>

                    {{ Form::close()}}
                    {{--<td><input type="checkbox"  name="checked" value="true" ></td>--}}



                    <td>{{ $todo->task }}</td>


                    <td><form method="POST" action="{{url('/avatars', [$todo->id])}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <label class="form-control-file " >
                                <input  type="file" name="avatar" class="filestyle" />
                            </label>

                            <br>

                            <button class="btn btn-success" type="submit">Save image</button>

                        </form></td>

                    <td>@if(App\Todo::where('id',$todo->id)->first()->image) {{Html::image('images/'.App\Todo::where('id',$todo->id)->first()->image, "Choose your image", array( 'width' => 70, 'height' => 70 )) }}@endif</td>

                    <td><form action="/todo/{{ $todo->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button class="btn btn-danger">Delete Task  <span class="glyphicon glyphicon-trash"></span></button>
                        </form></td>
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



@stop







