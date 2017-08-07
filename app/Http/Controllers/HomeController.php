<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Repositories\TodoRepositoryInterface;
use Illuminate\Support\Facades\Input;


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

    public function image(){
        $complete=$this->todos->complete();

        $incomplete=$this->todos->incomplete();

        $notcomplete=$this->todos->notcomplete();

        $notcompleteWork=$this->todos->notcompleteWork();

        $notcompleteHome=$this->todos->notcompleteHome();

        $notcompleteSchool=$this->todos->notcompleteSchool();

        $notcompleteFreeTime=$this->todos->notcompleteFreeTime();

        $user=Auth::user();
        return View::make('profile', compact('complete','incomplete','notcomplete','notcompleteWork','notcompleteHome','notcompleteFreeTime','notcompleteSchool','user'));
    }

    public function upload(Request $request){
        $userId=$request->get('userId');

        $user=User::where('id',$userId)->first();

        $file= $request->file('avatar');


        $imageName=$this->todos->getName($file);
        $path = '/home/imi/Downloads/to-do-list3-master/public/images';



        $file->move($path , $imageName);

        $user->avatar=$imageName;

        $user->save();

        return Redirect::back();
    }



    public function editProfile(){
        $complete=$this->todos->complete();

        $incomplete=$this->todos->incomplete();

        $notcomplete=$this->todos->notcomplete();

        $notcompleteWork=$this->todos->notcompleteWork();

        $notcompleteHome=$this->todos->notcompleteHome();

        $notcompleteSchool=$this->todos->notcompleteSchool();

        $notcompleteFreeTime=$this->todos->notcompleteFreeTime();

        $user=Auth::user()->first();

        return View::make('editProfile',compact('complete','incomplete','notcomplete','notcompleteWork','notcompleteHome','notcompleteFreeTime','notcompleteSchool','user'));
    }
}
