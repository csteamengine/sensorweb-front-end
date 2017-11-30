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

    public function readings(){
        $leafnodes = $this->leafnodes()->get();
        $readings = array();

        foreach($leafnodes as $leafnode){
            foreach($leafnode->readings()->get() as $reading){
                array_push($readings, $reading);
            }
        }

        return $readings;
    }

    public function avgReadings(){
        $readings = $this->readings();
        $storage = array();

        foreach($readings as $reading){

            if(array_key_exists("".$reading->created_at, $storage)){
                array_push($storage["".$reading->created_at], $reading->value);
            }else{
                $storage["". $reading->created_at] = array();
                array_push($storage["".$reading->created_at], $reading->value);
            }
        }

        $results = array();
        foreach($storage as $key => $slot){
            $sum = 0;
            foreach($slot as $index){
                $sum += $index;
            }
            $results[$key] = round($sum/sizeof($slot), 2);
        }
        ksort($results);
        return $results;
    }

    public function overallAverage(){
        $averages = $this->avgReadings();
        $total = 0;
        foreach($averages as $average){
            $total += $average;
        }
        return $total/sizeof($averages);
    }
}
