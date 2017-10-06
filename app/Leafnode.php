<?php

namespace SensorWeb\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Leafnode extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function homenode(){
        return $this->belongsTo('SensorWeb\Models\Homenode');
    }

    public function readings(){
        return $this->hasMany('SensorWeb\Models\Reading');
    }

}
