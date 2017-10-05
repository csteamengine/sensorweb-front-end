<?php

namespace SensorWeb\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(){
        return view('home');
    }

    public function analysis(){
        return view('analysis');
    }

    public function settings(){
        return view('settings');
    }

}
