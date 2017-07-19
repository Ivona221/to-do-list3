<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable=['task','user_id','date','checked','start_date','start_time','end_date','end_time'];//temp

    public function images(){
        return $this->hasMany('App\Image');
    }
}
