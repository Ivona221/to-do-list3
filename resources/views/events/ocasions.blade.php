@extends('app')

@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))

@section('content')



    <div class="container" >
        <h2>Events</h2>
        @include('partials.ocasionTable',array('occasions'=>$occasions))
    </div>




    <script src="js/navBar.js"></script>
@stop