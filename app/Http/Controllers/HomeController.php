<?php

namespace SensorWeb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $homenodes = $user->homenodes()->get();

        $homenode = $homenodes[0];

        $leafnodes = $user->leafnodes();
        $firstNodeReadings = $homenode->leafnodes()->first()->readings()->get();

        $firstNodeAvg = $homenode->avgReadings();

        $readings = $user->readings();
        return view('home', ['homenodes' => $homenodes, 'leafnodes' => $leafnodes, 'readings' => $readings, 'user' => $user, 'firstNodeReadings' => $firstNodeReadings, 'firstNodeAvg' => $firstNodeAvg]);
    }

    public function analysis(){
        $user = Auth::user();
        return view('analysis', ['user' => $user]);
    }

    public function settings(){
        $user = Auth::user();
        return view('settings', ['user' => $user]);
    }

}
