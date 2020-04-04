<?php

namespace App\Http\Controllers\Auth;

use Cloudder;
use App\Models\User;
use App\Models\Address;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorRegisterCtrl extends Controller
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
         
        $user = User::create([
        	'firstname' => $request->firstname,
        	'lastname' => $request->lastname,
          'email' => $request->email,
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

        		if ($request->hasFile('photo')) {

		            //return 'Good From Here';
		            Cloudder::upload($request->file('photo'));
		            $cloundary_upload = Cloudder::getResult();
		            
		            $doctor = new Doctor([
					      	'username' => $request->input('username'),
					      	'gender' => $request->input('gender'),
					      	'speciality' => $request->input('speciality'),
						      'license_id'	=> $request->input('license_id'),
				          'license_issue_date'  => $request->input('license_issue_date'),
				          'license_expiry_date'  => $request->input('license_expiry_date'),
					      	'affliated_hospital' => $request->input('affliated_hospital'),
						      'why' => $request->input('why'),
						      'photo' => $cloundary_upload['url']
					      ]);

					      $user->doctors()->save($doctor);
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
