<?php

namespace SensorWeb\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
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

    public function getHomeNode($id){
        $user = Auth::user();
        $errors = [];

        $existing = $user->homenodes()->find($id)->first();

        if($existing){
            return view('nodes/homenode', ['homenode' => $existing]);
        }else{
            $homenodes = $user->homenodes()->get();
            array_push($errors, 'You do not have access to that Home Node');
            return redirect()->route('homeNodes')->with(['homenodes'=>$homenodes, 'errors'=>$errors]);
        }
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

    public function removeHomeNode($id){
        //TODO remove home node from user_homenodes;
        $user = Auth::user();
        $errors =[];

        $homenode = $user->homenodes()->where('homenode_id', $id)->first();

        if($homenode){
            $user->homenodes()->detach($id);
        }else{
            array_push($errors, 'You cannot remove that home node.');
        }

        $homenodes = $user->homenodes()->get();
        return redirect()->route('homeNodes')->with(['homenodes' => $homenodes, 'errors' => $errors]);
    }

    public function homeNodes(){
        $user = Auth::user();
        $homenodes = $user->homenodes()->get();

        return view('nodes/homeNodes', ['homenodes' => $homenodes]);
    }

    public function leafNodes(){
        $user = Auth::user();
        $errors = [];

        $leafnodes = [];
        foreach($user->homenodes()->get() as $homenode){
            $currLeafnodes = $homenode->leafnodes()->get();

            if(sizeof($currLeafnodes)){

                foreach($currLeafnodes as $leafnode){
                    $leafnode->homenode = $homenode;

                    array_push($leafnodes, $leafnode);
                }
            }
        }

        return view('nodes/leafNodes', ['leafnodes' => $leafnodes, 'errors' => $errors]);
    }
}
