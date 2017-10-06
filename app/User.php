<?php

namespace SensorWeb;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function homenodes(){
        return $this->belongsToMany('SensorWeb\Models\Homenode', 'user_homenodes', 'user_id', 'homenode_id')->withPivot('nickname');
    }
}
