<?php

namespace App\Http\Controllers\Auth;

use Cloudder;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MobileRegisterCtrl extends Controller
{


		/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }


    protected function create(Request $request)
    {

        $validator = $this->validator($request->all());


        if ($validator->fails()) {

          return response()->json([
            'status' => 'Error',
            'message' => $validator->messages()
          ]);
        }

        $uuid = (string) Str::uuid();
         
        $user = User::create([
        	'firstname' => $request->firstname,
        	'lastname' => $request->lastname,
          'email' => $request->email,
          'username' => $request->username,
          'password' => Hash::make($request->password),
          'uuid' => $uuid
        ]);
        

        if ($user) {
            
          return response()->json([
              'status' => 'Success',
              'message' => 'Kindly Login',
            ]);
  
        } else {
          return response()->json([
            'status' => false,
            'message' => 'Kindly singnup again'
          ]);
        }

    }
		
}
