<?php

namespace SensorWeb\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Datatype extends Model
{
    use Notifiable;

    public function leafnode(){
        return $this->belongsTo('SensorWeb\Model\Leafnode');
    }
}
