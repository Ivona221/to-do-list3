@section('title')



    <p>Progress: Completed {{$complete}}/{{$incomplete}} tasks</p>

    <div id="myProgress" style="width:100%;">

        <div id="myBar"
             style="width:calc(({{$complete}}/{{$incomplete}})*100%); background-color:#bababa;color:transparent; border-radius: 6px;">
            Hi
        </div>
    </div>



@stop

@section('completedAll')
    <span>{{ $notcomplete }}</span>
@stop

@section('completedHome')
    <span>{{ $notcompleteHome }}</span>
@stop

@section('completedWork')
    <span>{{ $notcompleteWork }}</span>
@stop

@section('completedSchool')
    <span>{{ $notcompleteSchool }}</span>
@stop

@section('completedFreeTime')
    <span>{{ $notcompleteFreeTime }}</span>
@stop
