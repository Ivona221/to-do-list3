@extends('app')

@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))



@section('content')



    <div class="container">
        <p>This page has {{$views}} views</p>
        <h2>Tasks for {{$date}} </h2>
        @include('partials.table', array('todos',$todos))
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>

        $(document).ready(function () {
            $('#ck').on('change', function () {
                $('#btn').submit();
            });
        });

    </script>




@stop







