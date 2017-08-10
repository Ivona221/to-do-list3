@extends('app')
@include('partials.sidebar', array('complete'=>$complete,'incomplete'=>$incomplete,'notcomplete'=>$notcomplete,'notcompleteWork'=>$notcompleteWork,
'notcompleteHome'=>$notcompleteHome, 'notcompleteSchool'=>$notcompleteSchool, 'notcompleteFreeTime'=>$notcompleteFreeTime))
@section('content')
    @if ($message = Session::get('success'))
        <div class="custom-alerts alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            {!! $message !!}
        </div>
        <?php Session::forget('success');?>
    @endif
    @if ($message = Session::get('error'))
        <div class="custom-alerts alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            {!! $message !!}
        </div>
        <?php Session::forget('error');?>
    @endif


    <div class="col-sm-offset-1 col-sm-3 " >
        <div class="panel panel-default bg-warning">
            <div class="panel-heading bg-success" style="background-color:#896978 ;color:white;">
                <h3 >Immediate</h3>
                <hr>
                <p style="font-size: 20px">$9.99/month</p>
                <p ><form action="/newSubImmediate" method="POST">
                    {{ csrf_field() }}
                    <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button btn-success"
                            data-key="pk_test_YO2uwcqiZIMLdGewYuDeFhbB"
                            data-image="/images/sub1.svg"
                            data-name="Immediate Plan"
                            data-description="Immediate subscription"
                            data-amount="999.9"
                            data-email="{{\Illuminate\Support\Facades\Auth::user()->email}}"
                            data-label="Subscribe">
                    </script>
                    <script>

                        document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';
                    </script>
                    <button type="submit" class="btn btn-custom">Subscribe</button>
                </form></p>
            </div>
            <div style="padding: 5px;">
                <h4>Benefits of this membership</h4>
                <ul>
                    <li>
                        Lorem ipsum dolor sit amet, mel esse ubique noster ad, vis eu nemore tractatos.
                    </li>
                    <li>
                        Eu pri dissentias honestatis, pri in ludus debitis minimum.
                    </li>
                    <li>
                        Feugait oportere vel eu.
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="col-sm-offset-1 col-sm-3 ">
        <div class="panel panel-default bg-warning">
            <div class="panel-heading bg-success" style="background-color: #839791; color:white;">
                <h3 >Gold</h3>
                <hr>
                <p style="font-size: 20px">$10.00/month</p>
                <p style="padding-left:50%;"><form action="/newSubGold" method="POST">
                    {{ csrf_field() }}
                    <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button btn-success"
                            data-key="pk_test_YO2uwcqiZIMLdGewYuDeFhbB"
                            data-image="/images/sub1.svg"
                            data-name="Gold Plan"
                            data-description="Gold subscription"
                            data-amount="1000"
                            data-email="{{\Illuminate\Support\Facades\Auth::user()->email}}"
                            data-label="Subscribe">
                    </script>
                    <script>

                        document.getElementsByClassName("stripe-button-el")[1].style.display = 'none';
                    </script>
                    <button type="submit" class="btn btn-custom">Subscribe</button>
                </form></p>
            </div >
            <div style="padding: 5px;">
                <h4>Benefits of this membership</h4>
                <ul>
                    <li>
                        Lorem ipsum dolor sit amet, mel esse ubique noster ad, vis eu nemore tractatos.
                    </li>
                    <li>
                        Eu pri dissentias honestatis, pri in ludus debitis minimum.
                    </li>
                    <li>
                        Feugait oportere vel eu.
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="col-sm-offset-1 col-sm-3 ">
        <div class="panel panel-default bg-warning">
            <div class="panel-heading bg-success" style="background-color: #839791;color:white;">
                <h3 >Diamond</h3>
                <hr>
                <p style="font-size: 20px">$20.00/month</p>
                <p style="padding-left:50%;"><form action="/newSubDiamond" method="POST">
                    {{ csrf_field() }}
                    <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="pk_test_YO2uwcqiZIMLdGewYuDeFhbB"
                            data-image="/images/sub1.svg"
                            data-name="Diamond Plan"
                            data-description="Diamond subscription"
                            data-amount="2000"
                            data-email="{{\Illuminate\Support\Facades\Auth::user()->email}}"
                            data-label="Subscribe" >
                    </script>
                    <script>

                        document.getElementsByClassName("stripe-button-el")[2].style.display = 'none';
                    </script>
                    <button type="submit" class="btn btn-custom">Subscribe</button>
                </form></p>
            </div>
            <div style="padding: 5px;">
                <h4>Benefits of this membership</h4>
                <ul>
                    <li>
                        Lorem ipsum dolor sit amet, mel esse ubique noster ad, vis eu nemore tractatos.
                    </li>
                    <li>
                        Eu pri dissentias honestatis, pri in ludus debitis minimum.
                    </li>
                    <li>
                        Feugait oportere vel eu.
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <a href="/cancelSubscription" style="position:relative; left:48%;"><button class="btn btn-danger">Cancel Subscription</button></a>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('#users_list').select2({
            placeholder: 'Choose Participants',
        });

        $("#select").on('change', function () {
            $('#hiddenSelect').val($('#select').val());
        });
    </script>


@stop