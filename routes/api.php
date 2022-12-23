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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::namespace('Api')->group(function(){
    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');
    Route::post('/send-email', 'UserController@sendEmail');
    Route::post('/check-otp', 'UserController@checkOtp');
    Route::post('/reset-password', 'UserController@resetPassword');
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/home', 'HomeController@index');
    });
});