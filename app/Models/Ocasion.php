<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ocasion extends Model
{
    protected $fillable = [
        'organizer_id', 'name', 'place','date', 'time',
    ];

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function usersList(){
        return $this->users->pluck('id');
    }

    public function usersEmail(){
        return $this->users->pluck('email');
    }
}
