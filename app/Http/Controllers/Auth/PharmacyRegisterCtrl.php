<?php

namespace App\Http\Controllers\Auth;

use Cloudder;
use App\Models\User;
use App\Models\Address;
use App\Models\Pharmacy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class PharmacyRegisterCtrl extends Controller
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
          'password' => Hash::make($request->password),
          'role' => 'pharmacy',
          'uuid' => $uuid
        ]);
        
        if ($user) {

        		$user->address()->save(new Address([
        			'address'	=> $request->input('address'),
	            'city'	=> $request->input('city'),
	            'state'	=> $request->input('state'),
	            'country'	=> $request->input('country'),
	            'phone'	=> $request->input('phone'),
			      ]));

        		if ($request->hasFile('photo')) {

		            //return 'Good From Here';
		            Cloudder::upload($request->file('photo'));
		            $cloundary_upload = Cloudder::getResult();
		            
		            $pharmacy = new Pharmacy([
					      	'gender' => $request->input('gender'),
						      'why' => $request->input('why'),
						      'photo' => $cloundary_upload['url']
					      ]);

					      $user->pharmacies()->save($pharmacy);
		        }
            
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
