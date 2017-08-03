<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{
    protected $fillable = [
        'organizer_id', 'name', 'place','date', 'time',
    ];

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
