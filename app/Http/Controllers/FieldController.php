<?php

namespace SensorWeb\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FieldController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function fields(){
        return view('fields');
    }

}
