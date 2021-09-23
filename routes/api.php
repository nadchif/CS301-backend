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

Route::group(['prefix' => '/', 'middleware' => ['jsonify']], function () {

    // API status
    Route::get('/', '\App\Http\Controllers\ApiStatusController@status');

    // User routes
    Route::post('user', 'App\Http\Controllers\UserController@store');
    Route::middleware('auth:api')->delete('user/{id}', 'App\Http\Controllers\UserController@delete');
    Route::middleware('auth:api')->get('user/{id}', 'App\Http\Controllers\UserController@get');
    Route::middleware('auth:api')->patch('user/{id}', 'App\Http\Controllers\UserController@patch');

    // auth & verification routes
    Route::get('user/verify/{id}', 'App\Http\Controllers\VerificationController@verify')->name('verification.verify');
    Route::post('user/resend', 'App\Http\Controllers\VerificationController@resend')->name('verification.resend');
    Route::post('user/forgot-password', 'App\Http\Controllers\ForgotPasswordController@requestLink')->middleware('guest')->name('password.email');
    Route::get('user/reset-password', 'App\Http\Controllers\ForgotPasswordController@resetPasswordToken')->middleware('guest')->name('password.reset');
    Route::post('user/reset-password', 'App\Http\Controllers\ForgotPasswordController@setNewPassword')->middleware('guest')->name('password.update');



    // API fallback
    Route::fallback('\App\Http\Controllers\ApiStatusController@fallback');
});
