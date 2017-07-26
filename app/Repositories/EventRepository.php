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




}