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
    Route::post('login/','Auth\LoginCtrl@login');
    Route::post('signup/doctor','Auth\DoctorRegisterCtrl@create');
    Route::post('signup/admin','Auth\RegisterController@create');
    Route::post('signup/','Auth\RegisterCtrl@create');

    Route::middleware('auth:api')->group( function ()
    {
        # code...
        
        Route::post('logout', 'Auth\LoginController@logout');

    });

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
