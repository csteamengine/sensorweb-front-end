<?php

namespace SensorWeb\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NodeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function userProfile(){

    }

    public function addHomeNode(){

    }

    public function removeHomeNode(){

    }

    public function homeNodes(){
        return view('homeNodes');
    }

    public function leafNodes(){
        return view('leafNodes');
    }
}
