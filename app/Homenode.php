<?php

namespace SensorWeb\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Homenode extends Model
{
    use Notifiable;

    public function users(){
        return $this->belongsToMany('SensorWeb\User', 'user_homenodes', 'homenode_id', 'user_id');
    }
    public function leafnodes(){
        return $this->hasMany('SensorWeb\Models\Leafnode');
    }
}
