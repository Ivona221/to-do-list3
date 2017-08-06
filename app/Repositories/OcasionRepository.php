<?php
/**
 * Created by PhpStorm.
 * User: Athena
 * Date: 7/25/2017
 * Time: 8:22 PM
 */

namespace App\Repositories;

use App\User;
use App\Todo;
use Illuminate\Support\Facades\Auth;
use Repositories\EventRepositoryInterface;
use App\Event;
use Repositories\OcasionRepositoryInterface;
use App\Ocasion;

class OcasionRepository implements OcasionRepositoryInterface
{
    /**
     * TodoRepository constructor.
     */

    public function __construct(Ocasion $ocasion)
    {
        $this->ocasion = $ocasion;
    }

    public function create($data)
    {
        return $this->ocasion->create($data);
    }

    public function userId(){
        return Auth::user()->id;
    }

    public function allUsers(){
        return User::all();
    }

    public function attachPart($participants, $ocasion){
        return $ocasion->users()->attach($participants);


    }

    public function userMail($ocasion){
        return $ocasion->usersEmal();
    }

    public function pluck(){
        return User::pluck('name','id')->toArray();
    }

    public function complete(){
        return \App\Todo::where(['checked'=>true,'user_id'=>Auth::user()->id])->get()->count();
    }

    public function incomplete(){
        return \App\Todo::where(['user_id'=>Auth::user()->id])->get()->count();

    }

    public function notcomplete(){
        return \App\Todo::where(['checked'=>false,'user_id'=>Auth::user()->id])->orWhere(['checked'=>NULL,'user_id'=>Auth::user()->id])->get()->count();
    }

    public function notcompleteWork(){
        return \App\Todo::where(['checked'=>false,'user_id'=>Auth::user()->id,'type'=>"work"])->orWhere(['checked'=>NULL,'user_id'=>Auth::user()->id, 'type'=>"work"])->count();
    }

    public function notcompleteHome(){
        return \App\Todo::where(['checked'=>false,'user_id'=>Auth::user()->id,'type'=>'home'])->orWhere(['checked'=>NULL,'user_id'=>Auth::user()->id, 'type'=>'home'])->count();
    }

    public function notcompleteSchool(){
        return \App\Todo::where(['checked'=>false,'user_id'=>Auth::user()->id,'type'=>'school'])->orWhere(['checked'=>NULL,'user_id'=>Auth::user()->id, 'type'=>'school'])->count();
    }

    public function notcompleteFreeTime(){
        return \App\Todo::where(['checked'=>false,'user_id'=>Auth::user()->id,'type'=>'free_time'])->orWhere(['checked'=>NULL,'user_id'=>Auth::user()->id, 'type'=>'free_time'])->count();
    }

    public function name($id){
        return Ocasion::where('id',$id)->first()->name;

    }
    public function time($id){
        return  Ocasion::where('id',$id)->first()->time;

    }

    public function date($id){
        return Ocasion::where('id',$id)->first()->date;

    }

    public function place($id){
        return Ocasion::where('id',$id)->first()->place;


    }

    public function organizerId($id){
        return Ocasion::where('id',$id)->first()->organizer_id;
    }

    public function occasion($id){
        return Ocasion::where('id',$id)->first();
    }

    public function syncUsers($occasion, $users){
        return $occasion->users()->sync($users);

    }


}