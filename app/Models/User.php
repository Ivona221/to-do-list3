<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;


class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','provider', 'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates=[
        'trial_ends_at','subscription_ends_at',
    ];


    public function todos() {
        return $this->hasMany('App\Todo');
    }

    public function events() {
        return $this->hasMany('App\Event');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function ocasions(){
        return $this->belongsToMany('App\Ocasion')->withTimestamps();
    }


}

