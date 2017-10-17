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
use SensorWeb\Models\Reading;
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

        $homenode = $user->homenodes()->find($id);
        if($homenode){
            $leafnodes = $homenode->leafnodes()->get();
            return view('nodes/homeNode', ['homenode' => $homenode, 'leafnodes' => $leafnodes, 'user' => $user]);
        }else{
            $homenodes = $user->homenodes()->get();
            array_push($errors, 'You do not have access to that Home Node');
            return redirect()->route('homeNodes')->with(['homenodes'=>$homenodes, 'errors'=>$errors, 'user' => $user]);
        }
    }

    public function getLeafNodeData($id){
        $user = Auth::user();
        $errors = [];

        //TODO check if user owns leafnode
        $found = false;
        $leafnodes = $user->leafnodes();
        $leafnode = $leafnodes[0];
        foreach($leafnodes as $curr){
            if($curr->id == $id){
                $found = true;
                $leafnode = $curr;
                break;
            }
        }
        if($found){
            $readings = $leafnode->readings()->get();
            return view('nodes/leafNode', ['leafnode' => $leafnode, 'readings' => $readings, 'user' => $user]);
        }else{
            $leafnodes = $user->leafnodes()->get();
            array_push($errors, 'You do not have access to that Home Node');
            return redirect()->route('homeNodes')->with(['leafnodes'=>$leafnodes, 'errors'=>$errors, 'user' => $user]);
        }
    }

    //Removes a reading data from the table.
    public function removeReading($id){
        $user = Auth::user();
        $errors = [];
        $reading = Reading::find($id);
        if($reading){
            $leafnodes = $user->leafnodes();
            foreach($leafnodes as $leafnode){
                if($reading->leafnode_id == $leafnode->id){
                    $reading->delete();
                    return redirect()->route('getLeafnodeData', ['id' => $leafnode->id, 'user' => $user]);
                }
            }
        }
        array_push($errors, 'You do not have access to that data.');

        return redirect()->route('leafNodes')->with(['errors' => $errors, 'user' => $user]);

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

        return redirect()->route('homeNodes')->with(['homenodes' => $homenodes, 'errors' => $errors, 'user' => $user]);
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
        return redirect()->route('homeNodes')->with(['homenodes' => $homenodes, 'errors' => $errors, 'user' => $user]);
    }

    public function editHomenode($id){
        $user = Auth::user();
        $errors = [];

        $homenode = $user->homenodes()->find($id);
        if($homenode){
            return view('nodes/editHomeNode', ['homenode' => $homenode, 'errors' => $errors, 'user' => $user]);
        }else{
            $homenodes = $user->homenodes()->get();
            array_push($errors, 'You do not have access to that Home Node');
            return redirect()->route('homeNodes')->with(['homenodes'=>$homenodes, 'errors'=>$errors, 'user' => $user]);
        }
    }

    public function updateHomenode(Request $request){
        $user = Auth::user();
        $errors = [];

        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'nickname' => 'required'
        ]);

        $homenode = $user->homenodes()->find($request->id);

        if($homenode){
            //Updates the homenode info and the pivot
            $homenode->latitude = $request->latitude;
            $homenode->longitude = $request->longitude;
            $homenode->pivot->nickname = $request->nickname;
            $homenode->save();
            $homenode->pivot->save();
            return redirect()->route('getHomenode', ['id' => $homenode->id, 'homenode' => $homenode, 'errors' => $errors, 'user' => $user]);
        }else{
            $homenodes = $user->homenodes()->get();
            array_push($errors, 'You do not have access to that Home Node');
            return redirect()->route('homeNodes')->with(['homenodes'=>$homenodes, 'errors'=>$errors, 'user' => $user]);
        }
    }

    public function homeNodes(){
        $user = Auth::user();
        $homenodes = $user->homenodes()->get();

        return view('nodes/homeNodes', ['homenodes' => $homenodes, 'user' => $user]);
    }

    public function leafNodes(){
        $user = Auth::user();
        $errors = [];

        $leafnodes = $user->leafnodes();

        return view('nodes/leafNodes', ['leafnodes' => $leafnodes, 'errors' => $errors, 'user' => $user]);
    }

}
