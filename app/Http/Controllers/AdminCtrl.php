<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Lab;
use App\Models\Pharmacy;
use App\Models\Hospital;
use App\Models\Patient;
use Auth;

class UsersCtrl extends Controller
{
    /**
     * Show the application dashboard.
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doctorList(Request $request)
    {
        $doctors = Doctor::all();
        return response()->json(['status' => 'success','result' => $doctors]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function labList(Request $request)
    {
        $labs = Lab::all();
        return response()->json(['status' => 'success','result' => $labs]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function patientList(Request $request)
    {
        $patients = Patient::all();
        return response()->json(['status' => 'success','result' => $patients]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pharmacyList(Request $request)
    {
        $pharmacies = Pharmacy::all();
        return response()->json(['status' => 'success','result' => $pharmacies]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hospitalList(Request $request)
    {
        $hospitals = Hospital::all();
        return response()->json(['status' => 'success','result' => $hospitals]);
    }


    /**
     * Create a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
          'lname' => 'required',
          'fname' => 'required',
          'email' => 'required'
        ]);
        
        $name = $request->input('fname') . ' ' . $request->input('lname');

        $supervisor = new Supervisor([
            'name' => $name,
            'email' => $request->input('email'),
          ]);


        $supervisor->save();

        return response()->json([
            'status' => 'success',
            'msg' => 'Added successfully'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supervisor = Supervisor::where('id', $id)->get();
        return response()->json($supervisor);
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDoctorStatus(Request $request, $id)
    {
        

        $Doctor = Doctor::find($id);
        if($supervisor->fill($request->all())->save()){
           return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'failed']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Supervisor::destroy($id)){
             return response()->json(['status' => 'success']);
        }
    }

}