<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
<<<<<<< HEAD
    protected $fillable=['task','user_id','date','checked','start_date','start_time','end_date','end_time','type'];//temp
=======
    protected $fillable=['task','user_id','date','checked','start_date','start_time','end_date','end_time'];//temp
>>>>>>> 82b1a04a83cab1abb72e82a1f1a3d6aea69c063b

    public function images(){
        return $this->hasMany('App\Image');
    }
<<<<<<< HEAD

    public function scopeDue($query)
    {
        return $query->where('end_time', '<=',\Carbon\Carbon::now()->addMinute(5)->format('H:i:s'));
    }

    public function scopeDue1($query){
        return $query->where('end_time', '<=',\Carbon\Carbon::now()->format('H:i:s'));

}
=======
>>>>>>> 82b1a04a83cab1abb72e82a1f1a3d6aea69c063b
}
