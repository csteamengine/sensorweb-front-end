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

    public function leafnodes(){
        $leafnodes = [];
        foreach($this->homenodes()->get() as $homenode){
            $currLeafnodes = $homenode->leafnodes()->get();

            if(sizeof($currLeafnodes)){

                foreach($currLeafnodes as $leafnode){
                    $leafnode->homenode = $homenode;

                    array_push($leafnodes, $leafnode);
                }
            }
        }
        return $leafnodes;
    }

    public function readings(){
        $leafnodes = $this->leafnodes();
        $allReadings = [];
        foreach($leafnodes as $leafnode){
            $readings = $leafnode->readings()->where('visited', 0)->get();
            if(sizeof($readings)){
                foreach($readings as $reading){
                    array_push($allReadings, $reading);
                    $reading->visited = 1;
                    $reading->save();
                }
            }
        }
        return $allReadings;
    }
}
