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
            {{ Form::open(array("url"=>"/check"))}}
            {{ Form::hidden('id', $todo->id) }}
            <input type="hidden" name="agree" value="1" >
            <input type="hidden" name="name" value="{{$todo->task}}">
            <td>{{  Form::checkbox('agree',1,$todo->checked ,['id' => 'ck','onChange'=>"this.form.submit()"]) }}</td>

            {{ Form::close()}}





            <td>{{ $todo->task }}</td>




            <td><form method="POST" action="{{url('/avatars', [$todo->id])}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <label class="form-control-file " >
                        <input  type="file" name="avatar" class="filestyle" />
                    </label>

                    <br>

                    <button id="save" class="btn btn-success" type="submit">Save image</button>

                </form></td>


            <td>@if($todo->image) {{Html::image('images/'.$todo->image, "Choose your image", array( 'width' => 70, 'height' => 70 )) }}@endif</td>


            <td><form action="/todo/{{ $todo->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button class="btn btn-danger">Delete Task  <span class="glyphicon glyphicon-trash"></span></button>
                </form></td>

            <td>

                    <a href="/edit/{{$todo->id}}"><button class="btn btn-info">Edit Task  <span class="glyphicon glyphicon-edit"></span></button></a>
                </td>




        </tr>
    @endforeach

    </tbody>
</table>