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
use Illuminate\Support\Facades\DB;



class TodoRepository implements TodoRepositoryInterface
{
    /**
     * TodoRepository constructor.
     */

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function byDate( $date){
        return $this->todo->where(['date'=>$date,'user_id'=>Auth::user()->id])->get();
    }

    public function count($date){
        return $this->todo->where(['date'=>$date])->count();

    }

    public function find($id){
        return $this->todo->findOrFail($id);
    }

    public function user(){
       return $this->todo->where(['user_id'=>Auth::user()->id])->get();
    }

    public function byType($type){
        return $this->todo->where(['type'=> $type,'user_id'=>Auth::user()->id])->get();
    }

    public function create($data)
    {
        $this->todo->create($data);
    }

    public function update($id, $imageName){

        $this->todo->where('id',$id)->update(['image' => $imageName]);

    }

    public function complete(){
        return \App\Todo::where(['checked'=>true,'user_id'=>Auth::user()->id])->get()->count();
    }

    public function incomplete(){
       return $this->todo->where(['user_id'=>Auth::user()->id])->get()->count();

    }

    public function notcomplete(){
        return \App\Todo::where(['checked'=>false,'user_id'=>Auth::user()->id])->get()->count();
    }

    public function order(){
        return $this->todo->select('date', DB::raw('count(*) as total'))->groupBy('date')
            ->orderBy('total', 'desc')
            ->get();
    }
}