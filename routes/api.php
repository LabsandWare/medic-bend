<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group( function ()
{
    # code...
    Route::post('login','Auth\LoginCtrl@login');
    Route::post('signup/doctor','Auth\DoctorRegisterCtrl@create');
    Route::post('signup/lab','Auth\LabRegisterCtrl@create');
    Route::post('signup/pharmacy','Auth\PharmacyRegisterCtrl@create');
    Route::post('signup/hospital','Auth\HospitalRegisterCtrl@create');
    Route::post('signup/admin','Auth\AdminController@create');
    Route::post('signup','Auth\RegisterCtrl@create');
    Route::post('mobile/signup','Auth\MobileRegisterCtrl@create');

    Route::middleware('auth:api')->group( function ()
    {
        # code...
        Route::get('user', 'UsersCtrl@index');
        Route::get('patient', 'PatientCtrl@index');
        Route::post('updatepatient', 'PatientCtrl@update');
        Route::get('doctor', 'UsersCtrl@index');
        Route::post('updatedoctor', 'DoctorCtrl@update');
        Route::get('Admin', 'AdminCtrl@index');
        Route::post('updatedoctor', 'AdminCtrl@update');
        Route::post('logout', 'Auth\LoginController@logout');

    });

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
