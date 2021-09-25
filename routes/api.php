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
    Route::middleware('auth:api')->patch('user/profile', 'App\Http\Controllers\UserController@updateProfile');
    Route::middleware('auth:api')->get('user/profile', 'App\Http\Controllers\UserController@profile');
    Route::middleware('auth:api')->get('user/{id}', 'App\Http\Controllers\UserController@get');

    // auth & verification routes
    Route::post('auth', 'App\Http\Controllers\LoginController@login');
    Route::get('user/verify/{id}', 'App\Http\Controllers\VerificationController@verify')->name('verification.verify');
    Route::post('user/resend', 'App\Http\Controllers\VerificationController@resend')->name('verification.resend');
    Route::post('user/forgot-password', 'App\Http\Controllers\ForgotPasswordController@requestLink')->middleware('guest')->name('password.email');
    Route::get('user/reset-password', 'App\Http\Controllers\ForgotPasswordController@resetPasswordToken')->middleware('guest')->name('password.reset');
    Route::post('user/reset-password', 'App\Http\Controllers\ForgotPasswordController@setNewPassword')->middleware('guest')->name('password.update');

    //orders
    Route::middleware('auth:api')->get('order/{id}', 'App\Http\Controllers\OrderController@get');
    Route::post('order/track', 'App\Http\Controllers\OrderController@getByTracking');
    Route::middleware('auth:api')->get('order', 'App\Http\Controllers\OrderController@index');
    Route::middleware('auth:api')->post('order', 'App\Http\Controllers\OrderController@post');

    //foods
    Route::get('foods/{id}', 'App\Http\Controllers\FoodController@get');
    Route::get('foods', 'App\Http\Controllers\FoodController@index');

    // API fallback
    Route::fallback('\App\Http\Controllers\ApiStatusController@fallback');
});
