<?php

namespace SensorWeb\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FieldController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fields(){
        return view('fields/fields');
    }

    public function addField(){
        //TODO add new field
        return view('fields/fields');
    }

    public function getField(){
        return view('fields/field');
    }

    public function removeField(){
        //TODO remove a field
        return view('fields/fields');
    }

}
