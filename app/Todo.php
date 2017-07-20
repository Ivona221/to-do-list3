<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable=['task','user_id','date','checked','start_date','start_time','end_date','end_time'];//temp

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function scopeDue($query)
    {
        return $query->where('end_time', '<=',\Carbon\Carbon::now()->addMinute(5)->format('H:i:s'));
    }

    public function scopeDue1($query){
        return $query->where('end_time', '<=',\Carbon\Carbon::now()->format('H:i:s'));

}
}
