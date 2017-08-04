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

class OcasionController extends Controller
{

    public function __construct(OcasionRepository $ocasions)
    {

        $this->ocasions = $ocasions;

    }

    public function eventCreate(){


        $organizer_id=Auth::user()->id;
        $userArray=User::all();

        $users=User::pluck('name','id')->toArray();
        foreach($userArray as $ua){
            $nameArray[$ua->name]=$ua->name;
        }

        $complete=$this->ocasions->complete();

        $incomplete=$this->ocasions->incomplete();

        $notcomplete=$this->ocasions->notcomplete();

        $notcompleteWork=$this->ocasions->notcompleteWork();

        $notcompleteHome=$this->ocasions->notcompleteHome();

        $notcompleteSchool=$this->ocasions->notcompleteSchool();

        $notcompleteFreeTime=$this->ocasions->notcompleteFreeTime();


        return View::make('events.createEvent', compact('organizer_id','users','complete','incomplete','notcomplete','notcompleteHome','notcompleteSchool','notcompleteFreeTime','notcompleteWork'));


    }

    public function eventNew(OcasionRequest $request){


        $ocasion=$this->ocasions->create($request->all());
        $participants=$request->get('users');
        //$this->ocasions->attachPart($ocasion,$participants);
        $ocasion->users()->attach($participants);
        $users = $ocasion->usersEmail();
            foreach ($users as $user) {
                Mail::send('emails.event', ['occasion' => $ocasion->name, 'place' => $ocasion->place, 'time' => $ocasion->time, 'date' => $ocasion->date], function ($m) use ($user) {
                    $m->to($user, $user)->subject('Invitation!');
                });
            }

        return Redirect::route('ocasion');

    }

    public function show(){

        $complete=$this->ocasions->complete();

        $incomplete=$this->ocasions->incomplete();

        $notcomplete=$this->ocasions->notcomplete();

        $notcompleteWork=$this->ocasions->notcompleteWork();

        $notcompleteHome=$this->ocasions->notcompleteHome();

        $notcompleteSchool=$this->ocasions->notcompleteSchool();

        $notcompleteFreeTime=$this->ocasions->notcompleteFreeTime();
        $occasions=Ocasion::all();

        $user=Auth::user()->id;

        return View::make('events.ocasions', compact('user','occasions','complete','incomplete','notcomplete','notcompleteHome','notcompleteSchool','notcompleteFreeTime','notcompleteWork'));
    }

    public function editOccasion($id){
        $complete=$this->ocasions->complete();

        $incomplete=$this->ocasions->incomplete();

        $notcomplete=$this->ocasions->notcomplete();

        $notcompleteWork=$this->ocasions->notcompleteWork();

        $notcompleteHome=$this->ocasions->notcompleteHome();

        $notcompleteSchool=$this->ocasions->notcompleteSchool();

        $notcompleteFreeTime=$this->ocasions->notcompleteFreeTime();

        $users=User::pluck('name','id')->toArray();

        $occasion=Ocasion::where('id',$id)->first();

        $organizer_id=Ocasion::where('id',$id)->first()->organizer_id;

        $name=Ocasion::where('id',$id)->first()->name;

        $place=Ocasion::where('id',$id)->first()->place;

        $date=Ocasion::where('id',$id)->first()->date;

        $time=Ocasion::where('id',$id)->first()->time;





        return View::make('events.edit', compact('name','place','date','time','users','organizer_id','occasion','complete','incomplete','notcomplete','notcompleteHome','notcompleteSchool','notcompleteFreeTime','notcompleteWork','id'));

    }

    public function editOcc(OcasionRequest $request){

        $id=$request->get('eventId');
        $occasion=Ocasion::findOrFail($id);
        $occasion->update($request->all());

        //laravel takes care of deleting and adding
        $this->syncUsers($occasion, $request->input('users'));

        $users = $occasion->usersEmail();
        foreach ($users as $user) {
            Mail::send('emails.event', ['occasion' => $occasion->name, 'place' => $occasion->place, 'time' => $occasion->time, 'date' => $occasion->date], function ($m) use ($user) {
                $m->to($user, $user)->subject('Invitation!');
            });
        }
        return Redirect::back();



    }

    private function syncUsers(Ocasion $occasion, array $users){
        $occasion->users()->sync($users);
    }
}
