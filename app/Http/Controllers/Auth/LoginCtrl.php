<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;


class LoginCtrl extends Controller
{
    
		/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function login(Request $request)
    { 

      $this->validate($request, [
        'email' => 'required',
        'password' => 'required'
      ]);

      $user = User::where('email', $request->email)->first();

      if (Hash::check($request->password, $user->password)) {
        # code...
        $token = $user->createToken('api_key')->accessToken;

        return response()->json([
          'status' => 'Success',
          'apikey' => $token
        ]);
      } else {
        return response()->json([
          'status' => 'fail'
        ], 401);
      }

    }

    public function logout(Request $request)
    {
    	# code...
    	
    }

}
