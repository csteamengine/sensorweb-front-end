<?php

namespace SensorWeb\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Datatype extends Model
{
    use Notifiable;

    public function leafnodes(){
        return $this->hasMany('SensorWeb\Models\Leafnode');
    }
}