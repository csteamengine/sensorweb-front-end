<?php

namespace SensorWeb\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Field extends Model
{
    use Notifiable;

    public function Field(){
        $this->hasMany('App/UserField');
    }
}
