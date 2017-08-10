<?php

namespace App\Http\Controllers;


use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Repositories\TodoRepositoryInterface;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TodoRepositoryInterface $todos)
    {
        $this->middleware('auth');
        $this->todos = $todos;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function image()
    {
        $complete = $this->todos->complete();
        $incomplete = $this->todos->incomplete();
        $notcomplete = $this->todos->notcomplete();
        $notcompleteWork = $this->todos->notcompleteWork();
        $notcompleteHome = $this->todos->notcompleteHome();
        $notcompleteSchool = $this->todos->notcompleteSchool();
        $notcompleteFreeTime = $this->todos->notcompleteFreeTime();

        $user = Auth::user();

        return View::make('profile', compact('complete', 'incomplete', 'notcomplete', 'notcompleteWork', 'notcompleteHome', 'notcompleteFreeTime', 'notcompleteSchool', 'user'));
    }

    public function upload(Request $request)
    {
        $userId = $request->get('userId');

        $user = User::where('id', $userId)->first();

        $file = $request->file('avatar');
        if (!$file) {
            return Redirect::back();
        } else {
            $imageName = $this->todos->getName($file);

            $path = '/home/imi/Downloads/to-do-list3-master/public/images';

            $file->move($path, $imageName);

            $user->avatar = $imageName;

            $user->save();

            return Redirect::back();
        }
    }


    public function editProfile()
    {
        $complete = $this->todos->complete();
        $incomplete = $this->todos->incomplete();
        $notcomplete = $this->todos->notcomplete();
        $notcompleteWork = $this->todos->notcompleteWork();
        $notcompleteHome = $this->todos->notcompleteHome();
        $notcompleteSchool = $this->todos->notcompleteSchool();
        $notcompleteFreeTime = $this->todos->notcompleteFreeTime();

        $user = Auth::user()->first();

        return View::make('editProfile', compact('complete', 'incomplete', 'notcomplete', 'notcompleteWork', 'notcompleteHome', 'notcompleteFreeTime', 'notcompleteSchool', 'user'));
    }

    public function showSubscribe()
    {
        $complete = $this->todos->complete();
        $incomplete = $this->todos->incomplete();
        $notcomplete = $this->todos->notcomplete();
        $notcompleteWork = $this->todos->notcompleteWork();
        $notcompleteHome = $this->todos->notcompleteHome();
        $notcompleteSchool = $this->todos->notcompleteSchool();
        $notcompleteFreeTime = $this->todos->notcompleteFreeTime();
        return View::make('subscription', compact('complete', 'incomplete', 'notcomplete', 'notcompleteWork', 'notcompleteHome', 'notcompleteFreeTime', 'notcompleteSchool'));
    }

    public function postSubscription(Request $request1)
    {


        $validator = Validator::make($request1->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            'amount' => 'required',
        ]);

        $input = $request1->all();
        if ($validator->passes()) {
            $input = array_except($input, array('_token'));

            $stripe = Stripe::make('sk_test_mZ8v6bq6B3yz9qeqqclfrExd');

            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request1->get('card_no'),
                        'exp_month' => $request1->get('ccExpiryMonth'),
                        'exp_year' => $request1->get('ccExpiryYear'),
                        'cvc' => $request1->get('cvvNumber'),
                    ],
                ]);
                if (!isset($token['id'])) {
                    Session::put('error', 'The Stripe Token was not generated correctly');

                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => $request1->get('amount'),
                    'description' => 'Add in wallet',
                ]);
                if ($charge['status'] == 'succeeded') {


                    Session::put('success', 'Successful transaction');
                    return redirect()->back();
                } else {
                    Session::put('error', 'Money not add in wallet!!');

                }


            } catch (Exception $e) {
                Session::put('error', $e->getMessage());

            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                Session::put('error', $e->getMessage());

            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                Session::put('error', $e->getMessage());

            }
        }


        $user = Auth::user();
        if ($user->subscribed('main')) {
            Session::put('error', 'You are already subscribed to a plan. Cancel the old subscription first!!');
            return Redirect::back();
        } else {
            Session::put('success', 'Successfully subscribed to a plan!!');
            $user->createStripeCustomer([
                'email' => $user->email,
            ]);
            $user->newSubscription('main', $request1->get('plan'))->create($request1->token);
            return Redirect::back();
        }


    }

    public function cancelSub()
    {

        $user = Auth::user();
        if($user->subscribed('main')) {
            $user->subscription('main')->cancelNow();
            DB::table('subscriptions')->where('user_id', $user->id)->delete();
            return Redirect::back();
        }
        else{
            Session::put('error','No active subscriptions!!');
            return Redirect::back();
        }
    }



    public function newSub()
    {
        \Stripe\Stripe::setApiKey("sk_test_mZ8v6bq6B3yz9qeqqclfrExd");
        if (Auth::user()->subscribed('main')) {
            Session::put('error', 'You are already subscribed to a plan. Cancel it first!!');
            return Redirect::back();
        } else {

            try {
                /* $customer = \Stripe\Customer::create(array(
                     'email' => $_POST['stripeEmail'],
                     'source' => $_POST['stripeToken'],
                     'plan' => 'immediate'
                 ));*/
                Auth::user()->newSubscription('main', '155')->create($_POST['stripeToken']);
                Session::put('success', 'Plan created successfully');
                return Redirect::back();

            } catch (Exception $e) {
                Session::put('error', 'Unable to sign you up');
                return Redirect::back();
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                Session::put('error', $e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                Session::put('error', $e->getMessage());
            }
        }
    }

    public function newSubDiamond()
    {
        \Stripe\Stripe::setApiKey("sk_test_mZ8v6bq6B3yz9qeqqclfrExd");
        if (Auth::user()->subscribed('main')) {
            Session::put('error', 'You are already subscribed to a plan. Cancel it first!!');
            return Redirect::back();
        } else {
            try {
                /* $customer = \Stripe\Customer::create(array(
                     'email' => $_POST['stripeEmail'],
                     'source' => $_POST['stripeToken'],
                     'plan' => '123'
                 ));*/
                Auth::user()->newSubscription('main', '155')->create($_POST['stripeToken']);
                Session::put('success', 'Plan created successfully');
                return Redirect::back();

            } catch (Exception $e) {
                Session::put('error', 'Unable to sign you up');
                return Redirect::back();
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                Session::put('error', $e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                Session::put('error', $e->getMessage());
            }
        }
    }

    public function newSubGold()
    {
        \Stripe\Stripe::setApiKey("sk_test_mZ8v6bq6B3yz9qeqqclfrExd");
        if (Auth::user()->subscribed('main')) {
            Session::put('error', 'You are already subscribed to a plan. Cancel it first!!');
            return Redirect::back();
        } else {


            try {


                /*$customer = \Stripe\Customer::create(array(
                    'email' => $_POST['stripeEmail'],
                    'source' => $_POST['stripeToken'],
                    'plan' => '155'
                ));*/
                Auth::user()->newSubscription('main', '155')->create($_POST['stripeToken']);
                Session::put('success', 'Plan created successfully');
                return Redirect::back();

            } catch (Exception $e) {
                Session::put('error', 'Unable to sign you up');
                return Redirect::back();
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                Session::put('error', $e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                Session::put('error', $e->getMessage());
            }

        }
    }


}
