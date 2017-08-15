@extends('app')

@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))

@section('content')

    <table>
        <thead>
        <tr>
            <th>Most popular tasks by date</th>

        </tr>
        </thead>
        <tbody>
        @if($date1)
        @foreach($date1 as $d1)
            <tr>


                <td>{{$d1}}</td>


            </tr>
        @endforeach
        @endif

        </tbody>
    </table>
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