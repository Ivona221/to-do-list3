<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OcasionRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Requests\OcasionRequest;
use Illuminate\Support\Facades\Redirect;
use App\Ocasion;
use Illuminate\Support\Facades\Mail;
use Repositories\OcasionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\GlobalState\Exception;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Stripe\Stripe;
use App\Order;

class OcasionController extends Controller
{

    public function __construct(OcasionRepositoryInterface $ocasions)
    {

        $this->ocasions = $ocasions;

    }

    public function eventCreate()
    {


        $organizer_id = $this->ocasions->userId();

        $userArray = User::all();

        $users = $this->ocasions->pluck();

        foreach ($userArray as $ua) {
            $nameArray[$ua->name] = $ua->name;
        }

        $complete = $this->ocasions->complete();

        $incomplete = $this->ocasions->incomplete();

        $notcomplete = $this->ocasions->notcomplete();

        $notcompleteWork = $this->ocasions->notcompleteWork();

        $notcompleteHome = $this->ocasions->notcompleteHome();

        $notcompleteSchool = $this->ocasions->notcompleteSchool();

        $notcompleteFreeTime = $this->ocasions->notcompleteFreeTime();

        return View::make('events.createEvent', compact('organizer_id', 'users', 'complete', 'incomplete', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork'));


    }

    public function eventNew(Request $request1)
    {

        $ocasion = $this->ocasions->create($request1->all());

        $participants = $request1->get('users');

        $bool = true;

        $ocasion->users()->attach($participants);

        $users = $ocasion->usersEmail();

        foreach ($users as $user) {
            Mail::send('emails.event', ['occasion' => $ocasion->name, 'place' => $ocasion->place, 'time' => $ocasion->time, 'date' => $ocasion->date], function ($m) use ($user) {
                $m->to($user, $user)->subject('Invitation!');
            });
        }

        $validator = Validator::make($request1->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            'amount' => 'required',
        ]);

        $input = $request1->all();
        if ($validator->passes()) {
            $input = array_except($input,array('_token'));

            $stripe = Stripe::make('sk_test_mZ8v6bq6B3yz9qeqqclfrExd');

            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number'    => $request1->get('card_no'),
                        'exp_month' => $request1->get('ccExpiryMonth'),
                        'exp_year'  => $request1->get('ccExpiryYear'),
                        'cvc'       => $request1->get('cvvNumber'),
                    ],
                ]);
                if (!isset($token['id'])) {
                    Session::put('error','The Stripe Token was not generated correctly');
                    return redirect()->route('addmoney.paywithstripe');
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount'   => $request1->get('amount'),
                    'description' => 'Add in wallet',
                ]);
                if($charge['status'] == 'succeeded') {
                    $data=[
                        'user_id'=>Auth::user()->id,
                        'name'=>$request1->get('name'),
                        'stripe_transaction_id'=>1,


                    ];
                    $order=Order::create($data);
                    Session::put('success','Successful transaction');
                    return redirect()->back();
                } else {
                    Session::put('error','Money not add in wallet!!');
                    return redirect()->back();
                }
            } catch (Exception $e) {
                Session::put('error',$e->getMessage());
                return redirect()->back();
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                Session::put('error',$e->getMessage());
                return redirect()->back();
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
        Session::put('error','All fields are required!!');







    }

    public function show()
    {

        DB::Connection()->enableQueryLog();
        /*$complete = $this->ocasions->complete();
        $incomplete = $this->ocasions->incomplete();
        $notcomplete = $this->ocasions->notcomplete();
        $notcompleteWork = $this->ocasions->notcompleteWork();
        $notcompleteHome = $this->ocasions->notcompleteHome();
        $notcompleteSchool = $this->ocasions->notcompleteSchool();
        $notcompleteFreeTime = $this->ocasions->notcompleteFreeTime();*/

        $occasions = $this->ocasions->fetchAll();

        $log = DB::getQueryLog();

        print_r($log);

        $user = $this->ocasions->userId();

        return View::make('events.ocasions', compact('user', 'occasions'/*, 'complete', 'incomplete', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork'*/));
    }

    public function editOccasion($id)
    {
        $complete = $this->ocasions->complete();
        $incomplete = $this->ocasions->incomplete();
        $notcomplete = $this->ocasions->notcomplete();
        $notcompleteWork = $this->ocasions->notcompleteWork();
        $notcompleteHome = $this->ocasions->notcompleteHome();
        $notcompleteSchool = $this->ocasions->notcompleteSchool();
        $notcompleteFreeTime = $this->ocasions->notcompleteFreeTime();

        $users = $this->ocasions->pluck();


        $occasion = $this->ocasions->occasion($id);

        $organizer_id = $this->ocasions->organizerId($id);
        $name = $this->ocasions->name($id);
        $place = $this->ocasions->place($id);
        $date = $this->ocasions->date($id);
        $time = $this->ocasions->time($id);

        return View::make('events.edit', compact('name', 'place', 'date', 'time', 'users', 'organizer_id', 'occasion', 'complete', 'incomplete', 'notcomplete', 'notcompleteHome', 'notcompleteSchool', 'notcompleteFreeTime', 'notcompleteWork', 'id'));

    }

    public function editOcc(OcasionRequest $request)
    {

        $id = $request->get('eventId');

        $occasion = Ocasion::findOrFail($id);

        $occasion->update($request->all());

        //laravel takes care of deleting and adding
        $this->ocasions->syncUsers($occasion, $request->input('users'));

        $users = $occasion->usersEmail();

        foreach ($users as $user) {
            Mail::send('emails.event', ['occasion' => $occasion->name, 'place' => $occasion->place, 'time' => $occasion->time, 'date' => $occasion->date], function ($m) use ($user) {
                $m->to($user, $user)->subject('Invitation!');
            });
        }

        return Redirect::back();


    }

    public function validateStripe(Request $request){
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            'amount' => 'required',
        ]);

        $input = $request->all();
        if ($validator->passes()) {
            $input = array_except($input,array('_token'));

            $stripe = Stripe::make('sk_test_mZ8v6bq6B3yz9qeqqclfrExd');

            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number'    => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year'  => $request->get('ccExpiryYear'),
                        'cvc'       => $request->get('cvvNumber'),
                    ],
                ]);
                if (!isset($token['id'])) {
                    Session::put('error','The Stripe Token was not generated correctly');
                    return redirect()->route('addmoney.paywithstripe');
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount'   => $request->get('amount'),
                    'description' => 'Add in wallet',
                ]);
                if($charge['status'] == 'succeeded') {
                    /**
                     * Write Here Your Database insert logic.
                     */
                    Session::put('success','Money add successfully in wallet');
                    return redirect()->back();
                } else {
                    Session::put('error','Money not add in wallet!!');
                    return redirect()->back();
                }
            } catch (Exception $e) {
                Session::put('error',$e->getMessage());
                return redirect()->back();
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                Session::put('error',$e->getMessage());
                return redirect()->back();
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
        Session::put('error','All fields are required!!');
    }


}
