@extends('app')

@section('title')
    <div class="page-header">
        <h1>Weekly Task List</h1>
        <h2>Progress: Completed {{\App\Todo::where(['checked'=>true,'user_id'=>Auth::user()->id])->get()->count()}}/{{\App\Todo::where(['user_id'=>Auth::user()->id])->get()->count()}} tasks</h2>




    </div>

    @stop

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8 ">


            {{ Form::open(array("url"=>"/search"))}}
            <div class="panel panel-default bg-info">
                <div class="panel-heading bg-warning" >Search for previous tasks by date</div>
                <br>
                <div class="panel-body">
                    <input  type="date" name="date" id="date" >
                    <button type="submit">Search</button>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
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