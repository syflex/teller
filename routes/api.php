<?php

use Illuminate\Http\Request;

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

Route::namespace('Api')->group(function () {
    
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    Route::middleware('auth:api')->group(function () {        
        Route::get('token/user', 'UserController@user');
        Route::get('token/logout', 'UserController@logout');
        Route::get('get/balance/{account}', 'UserController@get_balance');
    });
});