
@extends('app')

@section('title')



    <p>Progress: Completed {{$complete}}/{{$incomplete}} tasks</p>
    <div id="myProgress" style="width:100%; color:gray;">

        <div id="myBar" style="width:calc(({{$complete}}/{{$incomplete}})*100%); background-color:#bababa;color:transparent; border-radius: 6px;">Hi</div>
    </div>



@stop



@section('content')

<h2>Statistics for each day</h2>
<table class="table table-striped">

    <thead>
    <tr>
        <th>Date</th>
        <th>#Tasks</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order as $dt)
        <tr>

            </td>
            <td>{{$dt->date}}</td>
            <td>{{$dt->total}}</td>

        </tr>
    @endforeach



    </tbody>
</table>



@stop