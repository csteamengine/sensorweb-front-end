<?php

namespace SensorWeb\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Reading extends Model
{
    use Notifiable;

    public function leafnode(){
        return $this->belongsTo('SensorWeb\Model\Leafnode');
    }

    public function homenode(){
        return $this->leafnode()->homenode()->get();
    }

    public function datatype(){
        return $this->hasOne('SensorWeb\Model\Datatype');
    }
}
