<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use Auth;

class DoctorCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return response()->json([
          'status' => 'Success',
          'data' => $user
        ]);
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user) {

            $user->address()->save(new Address([
              'address' => $request->input('address'),
              'city'  => $request->input('city'),
              'state' => $request->input('state'),
              'country' => $request->input('country'),
              'phone' => $request->input('phone'),
            ]));

            if ($request->hasFile('photo')) {

                //return 'Good From Here';
                Cloudder::upload($request->file('photo'));
                $cloundary_upload = Cloudder::getResult();
                
                $doctor = new Doctor([
                  'gender' => $request->input('gender'),
                  'speciality' => $request->input('speciality'),
                  'license_id'  => $request->input('license_id'),
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