<?php

namespace SensorWeb\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use SensorWeb\User;

class UserController extends BaseController
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

    public function userProfile(){
        $user = Auth::user();
        return view('userProfile', ['user' => $user]);
    }

    public function updateUser(Request $request){
        $user = Auth::user();

        $request->validate([
           'username' => 'max:255',
           'email' => 'required|max:255',
           'first_name' => 'max:255',
           'last_name' => 'max:255',
           'address_line1' => 'max:255',
           'address_lin2' => 'max:255',
           'city' => 'max:255',
           'state' => 'max:255',
           'zip' => 'max:255'
        ]);

        $updateUser = User::find($user->id);

        $updateUser->username = $request->username;
        $updateUser->email = $request->email;
        $updateUser->first_name = $request->first_name;
        $updateUser->last_name = $request->last_name;
        $updateUser->address_line1 = $request->address_line1;
        $updateUser->address_line2 = $request->address_line2;
        $updateUser->city = $request->city;
        $updateUser->state = $request->state;
        $updateUser->zip = $request->zip;

        $updateUser->save();

        return redirect()->route('userProfile', ['user' => $updateUser]);

    }
}
