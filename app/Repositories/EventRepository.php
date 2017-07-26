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

class EventRepository implements EventRepositoryInterface
{
    /**
     * TodoRepository constructor.
     */

    public function __construct()
    {

    }

    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */

    public function find(){
        return Event::where('user_id', Auth::user()->id)->get();
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






}