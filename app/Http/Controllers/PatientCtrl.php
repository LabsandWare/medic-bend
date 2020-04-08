<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use Auth;

class PatientCtrl extends Controller
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
                    'address'   => $request->input('address'),
                'city'  => $request->input('city'),
                'state' => $request->input('state'),
                'country'   => $request->input('country'),
                'phone' => $request->input('phone'),
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
            'message' => 'User not registered'
          ]);
        }
    }

}