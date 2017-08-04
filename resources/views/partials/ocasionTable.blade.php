<table class="table table-striped">
    <thead>
    <tr>
        <th>Event</th>
        <th>Place</th>
        <th>Date</th>
        <th>Time</th>

    </tr>
    </thead>
    <tbody>
    @foreach($occasions as $occasion)
        <tr>


            {{--<td><a href="{{action('TodoController@check',array('id'=>$todo->id,'date'=>$date))}}">{{  Form::checkbox('agree')}}</a></td>--}}
            <td>{{ $occasion->name }}</td>

            <td>{{ $occasion->place }}</td>
            <td>{{ $occasion->date }}</td>
            <td>{{ $occasion->time }}</td>


            <td><form action="/occasion/{{ $occasion->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    @if($occasion->organizer_id==$user)
                    <button class="btn btn-danger" >Delete Event  <span class="glyphicon glyphicon-trash"></span></button>
                        @else
                        <button class="btn btn-danger" disabled>Delete Event  <span class="glyphicon glyphicon-trash"></span></button>
                        @endif
                </form></td>

            <td>
                @if($occasion->organizer_id==$user)
                <a href="/edit/occasion/{{$occasion->id}}"><button class="btn btn-info">Edit Event  <span class="glyphicon glyphicon-edit"></span></button></a>
                @else
                    <a href="/edit/occasion/{{$occasion->id}}"><button class="btn btn-info" disabled>Edit Event <span class="glyphicon glyphicon-edit"></span></button></a>
                    @endif
            </td>




        </tr>
    @endforeach

    </tbody>
</table>
