@extends('app')

@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))


@section('content')



    <div class="container">

        <div class="col-sm-offset-2 col-sm-9"style="margin-bottom:30px;">

            <div class="container">
                <div class="row">
                    <div class="col-md-7">

                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input id="date" type="date" class="form-control input-lg" placeholder="Buscar" value="{{$now}}" />
                                <span class="input-group-btn">
                                <a id="byDate" href="{{action('TodoController@byDate', array('date'=>$now))}}"><button class="btn btn-info btn-lg" type="button">
                                <i class="glyphicon glyphicon-search"></i>
                                </button>
                                </a>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>



        $(document).ready(function(){
            $('#date').on('change', function(){

                $('#byDate').attr("href", "http://127.0.0.1:8000/search/"+$('#date').val());
            });
        });




    </script>

    @include('errors.list')
    @foreach($date as $d)

        @include('partials.box', array('date'=>$d,'todos'=>$todos[$d]))

    @endforeach


@stop

@section('footer')

    @include('footer')
@stop