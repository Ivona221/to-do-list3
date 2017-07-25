@extends('app')

@section('title')

    <div class="page-header">

        <h2>Progress: Completed {{\App\Todo::where(['checked'=>true,'user_id'=>Auth::user()->id])->get()->count()}}/{{\App\Todo::where(['user_id'=>Auth::user()->id])->get()->count()}} tasks</h2>




    </div>

    @stop

@section('content')



    <div class="container">

        <div class="col-sm-offset-2 col-sm-9"style="margin-bottom:30px;">

            <div class="container">
                <div class="row">
                    <div class="col-md-6">

                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="date" class="form-control input-lg" placeholder="Buscar" />
                                <span class="input-group-btn">
                         <a id="byDate" href="{{action('TodoController@byDate', array('date'=>\Carbon\Carbon::now()->format('Y-m-d')))}}"><button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button></a>
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
    @include('partials.box',array('date'=>\Carbon\Carbon::now()->format('Y-m-d')))
    @include('partials.box' ,array('date'=>\Carbon\Carbon::tomorrow()->format('Y-m-d')))
    @include('partials.box', array('date'=>\Carbon\Carbon::now()->addDays(2)->format('Y-m-d')))
    @include('partials.box', array('date'=>\Carbon\Carbon::now()->addDays(3)->format('Y-m-d')))
    @include('partials.box', array('date'=>\Carbon\Carbon::now()->addDays(4)->format('Y-m-d')))
    @include('partials.box', array('date'=>\Carbon\Carbon::now()->addDays(5)->format('Y-m-d')))
    @include('partials.box', array('date'=>\Carbon\Carbon::now()->addDays(6)->format('Y-m-d')))



@stop

@section('footer')

    @include('footer')
@stop