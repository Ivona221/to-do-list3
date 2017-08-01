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
     * @param Todo $todo
     */

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function date(){
        return \Carbon\Carbon::now()->format('Y-m-d');
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
        return $this->todo->create($data);
    }



    public function update($id, $imageName){

        $this->todo->where('id',$id)->update(['image' => $imageName]);

    }

    public function complete(){
        return $this->todo->where(['checked'=>true,'user_id'=>Auth::user()->id])->get()->count();
    }

    public function incomplete(){
       return $this->todo->where(['user_id'=>Auth::user()->id])->get()->count();

    }

    public function notcomplete(){
        return $this->todo->where(['checked'=>false,'user_id'=>Auth::user()->id])->orWhere(['checked'=>NULL,'user_id'=>Auth::user()->id])->get()->count();
    }

    public function notcompleteWork(){
        return $this->todo->where(['checked'=>false,'user_id'=>Auth::user()->id,'type'=>"work"])->orWhere(['checked'=>NULL,'user_id'=>Auth::user()->id, 'type'=>"work"])->count();
    }

    public function notcompleteHome(){
        return $this->todo->where(['checked'=>false,'user_id'=>Auth::user()->id,'type'=>'home'])->orWhere(['checked'=>NULL,'user_id'=>Auth::user()->id, 'type'=>'home'])->count();
    }

    public function notcompleteSchool(){
        return $this->todo->where(['checked'=>false,'user_id'=>Auth::user()->id,'type'=>'school'])->orWhere(['checked'=>NULL,'user_id'=>Auth::user()->id, 'type'=>'school'])->count();
    }

    public function notcompleteFreeTime(){
        return $this->todo->where(['checked'=>false,'user_id'=>Auth::user()->id,'type'=>'free_time'])->orWhere(['checked'=>NULL,'user_id'=>Auth::user()->id, 'type'=>'free_time'])->count();
    }

    public function order(){
        return $this->todo->select('date', DB::raw('count(*) as total'))->groupBy('date')
            ->orderBy('total', 'desc')
            ->get();
    }

    public function time(){
        return \Carbon\Carbon::now()->format('H:i');

    }

    public function findId($id){
        return \App\Todo::findOrFail($id)->first();

    }

    public function id(){
        return Auth::user()->id;
    }

    public function updateChecked($id,$bool1){
        return DB::table('todos')->where('id', $id)->update(['checked' => $bool1]);
    }

    public function updateImage($id, $imageName){
        return DB::table('todos')
            ->where('id', $id)
            ->update(['image' => $imageName]);
    }

    public function getName($file){
        return $file->getClientOriginalName();
    }

    public function moveFile($file, $path, $imageName){
        return $file->move($path , $imageName);
    }









}