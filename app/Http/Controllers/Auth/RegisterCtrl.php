<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Address;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterCtrl extends Controller
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
            'password' => 'required|string|min:6|confirmed',
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
          'username' => $request->username,
        	'firstname' => $request->firstname,
        	'lastname' => $request->lastname,
          'email' => $request->email,
          'uuid' => $uuid,
          'password' => Hash::make($request->password)
        ]);
        
        if ($user) {

        		$user->address()->save(new Address([
        			'address'	=> $request->input('address'),
	            'city'	=> $request->input('city'),
	            'state'	=> $request->input('state'),
	            'country'	=> $request->input('country'),
	            'phone'	=> $request->input('phone'),
			      ]));
            
            $patient = new Patient([
			      	'gender' => $request->input('gender')
			      ]);

			      $user->patients()->save($patient);
            
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
