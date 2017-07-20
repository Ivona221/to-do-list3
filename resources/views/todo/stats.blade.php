
@extends('app')



@section('content')

<h2>Stats for each day</h2>
<table class="table table-striped">

    <thead>
    <tr>
        <th>Date</th>
        <th>#Tasks</th>
    </tr>
    </thead>
    <tbody>
    @foreach(\DB::table('todos')
    ->select('date', \DB::raw('count(*) as total'))

    ->groupBy('date')
    ->orderBy('total', 'desc')
    ->get() as $dt)
        <tr>

            </td>
            <td>{{$dt->date}}</td>
            <td>{{$dt->total}}</td>

        </tr>
    @endforeach



    </tbody>
</table>



@stop