<?php

namespace SensorWeb\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use SensorWeb\Models\Homenode;
use SensorWeb\User;

class NodeController extends BaseController
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

    public function addHomeNode(Request $request){
        $user = Auth::user();

        $errors = [];

        $request->validate([
            'unique_id' => 'required',
            'nickname' => 'required'
        ]);
        $existing = $user->homenodes()->where('unique_id', $request->unique_id)->first();
        if(!$existing){
            $homenode = Homenode::where('unique_id', $request->unique_id)->first();

            if($homenode){
                $userHomenodes = $user->homenodes()->attach($homenode->id);
                $user->homenodes()->save($homenode, ['nickname' => $request->nickname]);
            }else{
                array_push($errors, 'There is no homenode with that unique id');
            }
        }else{
            array_push($errors, 'You have already added that homenode.');
        }

        $homenodes = $user->homenodes()->get();

        return redirect()->route('homeNodes')->with(['homenodes' => $homenodes, 'errors' => $errors]);
    }

    public function removeHomeNode(){
        //TODO remove home node from user_homenodes;
        return view('nodes/homeNodes');
    }

    public function homeNodes(){
        $user = Auth::user();
        $homenodes = $user->homenodes()->get();

        return view('nodes/homeNodes', ['homenodes' => $homenodes]);
    }

    public function leafNodes(){
        return view('nodes/leafNodes');
    }
}
