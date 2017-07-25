<?php
/**
 * Created by PhpStorm.
 * User: imi
 * Date: 7/25/17
 * Time: 7:09 AM
 */

namespace App\Repositories;

use App\User;
use App\Todo;
use Illuminate\Support\Facades\Auth;


class TodoRepository
{
    /**
     * TodoRepository constructor.
     */

    private $em;

    public function __construct()
    {



    }

    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */



    public function forUser(User $user)
    {
        return $user->todos()
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function byDate( $date){
        return Todo::where(['date'=>$date,'user_id'=>Auth::user()->id])->get();
    }

    public function count($date){
        return Todo::where(['date'=>$date])->count();

    }

    public function find($id){
        return Todo::findOrFail($id);
    }

    public function user(){
       return Todo::where(['user_id'=>Auth::user()->id])->get();
    }

    public function byType($type){
        return Todo::where(['type'=> $type,'user_id'=>Auth::user()->id])->get();
    }
}