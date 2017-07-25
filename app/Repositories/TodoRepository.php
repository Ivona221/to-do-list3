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
use Repositories\TodoRepositoryInterface;



class TodoRepository implements TodoRepositoryInterface
{
    /**
     * TodoRepository constructor.
     */

    public function __construct()
    {
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