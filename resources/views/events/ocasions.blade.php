@extends('app')

@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))

@section('content')



    <div class="container" >
        <h2>Events</h2>
        @include('partials.ocasionTable',array('occasions'=>$occasions))
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



    <script src="js/navBar.js"></script>
@stop