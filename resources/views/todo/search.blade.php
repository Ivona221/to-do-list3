@extends('app')

@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))

@section('title')



    <p>Progress: Completed {{$complete}}/{{$incomplete}} tasks</p>
    <div id="myProgress" style="width:100%; color:gray;">

        <div id="myBar" style="width:calc(({{$complete}}/{{$incomplete}})*100%); background-color:#bababa;color:transparent; border-radius: 6px;">Hi</div>
    </div>



@stop

@section('content')



    <div class="container" >
        <h2>Tasks for {{$date}} </h2>
        @include('partials.table', array('todos',$todos))
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







