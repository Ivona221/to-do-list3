@extends('app')
@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))
@section('content')



    <div class="container">
        <div class="col-sm-offset-2 col-sm-8 ">
            <div class="panel panel-default bg-info">
                <div class="panel-heading bg-warning">

                    Add a new Event

                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @if ($message = Session::get('success'))
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            {!! $message !!}
                        </div>
                        {{ Session::forget('success')}}
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="custom-alerts alert alert-danger fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            {!! $message !!}
                        </div>
                    {{ Session::forget('error')}}
                @endif

                <!-- New Task Form -->
                    <form action="{{ url('/eventNew')}}" method="POST" class="form-horizontal">

                    {{ csrf_field() }}

                    <!-- Task Name -->
                        <div class="form-group">


                            <div class="col-sm-6">
                                <label for="occasion-name">Event</label>


                                <input type="text" name="name" id="occasion-name" class="form-control" value="">
                                <label for="occasion-place">Place</label>

                                <input type="text" name="place" id="occasion-place" class="form-control" value="">
                                <label for="occasion-date">Date</label>

                                <input type="date" name="date" id="occasion-date" class="form-control"
                                       value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">


                                <label for="occasion-time">Time</label>

                                <input type="time" name="time" id="occasion-time" class="form-control"
                                       value="{{\Carbon\Carbon::now()->format('H:i')}}">

                                <label for="participants">Choose participants</label>
                                {!! Form::select('users[]',[$users],null,['id'=>'users_list','class'=>'form-control','multiple']) !!}
                                <input type="hidden" name="organizer_id" value="{{$organizer_id}}">

                                <input type="hidden" name="stripe_transaction_id" value="{{str_random(15)}}">


                                <div class="panel-body">


                                    <div class="form-group{{ $errors->has('card_no') ? ' has-error' : '' }}">
                                        <label for="card_no" >Card No</label>

                                            <input id="card_no" type="text" class="form-control" name="card_no"
                                                   value="{{ old('card_no') }}" autofocus>
                                            @if ($errors->has('card_no'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('card_no') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                    <div class="form-group{{ $errors->has('ccExpiryMonth') ? ' has-error' : '' }}">
                                        <label for="ccExpiryMonth" >Expiry Month</label>

                                            <input id="ccExpiryMonth" type="text" class="form-control"
                                                   name="ccExpiryMonth" value="{{ old('ccExpiryMonth') }}" autofocus>
                                            @if ($errors->has('ccExpiryMonth'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('ccExpiryMonth') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                    <div class="form-group{{ $errors->has('ccExpiryYear') ? ' has-error' : '' }}">
                                        <label for="ccExpiryYear" >Expiry Year</label>

                                            <input id="ccExpiryYear" type="text" class="form-control"
                                                   name="ccExpiryYear" value="{{ old('ccExpiryYear') }}" autofocus>
                                            @if ($errors->has('ccExpiryYear'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('ccExpiryYear') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                    <div class="form-group{{ $errors->has('cvvNumber') ? ' has-error' : '' }}">
                                        <label for="cvvNumber" >CVV No.</label>

                                            <input id="cvvNumber" type="text" class="form-control" name="cvvNumber"
                                                   value="{{ old('cvvNumber') }}" autofocus>
                                            @if ($errors->has('cvvNumber'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('cvvNumber') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                        <label for="amount" >Price</label>

                                            <input id="amount" type="hidden" class="form-control" name="amount"
                                                   value="10" autofocus>
                                            <h4>10$</h4>

                                            @if ($errors->has('amount'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                            @endif
                                        </div>



                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Create an event
                                            </button>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>


                    </form>


                </div>
            </div>


        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('#users_list').select2({
            placeholder: 'Choose Participants',


        });


    </script>


@stop