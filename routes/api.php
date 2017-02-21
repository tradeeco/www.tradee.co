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

Route::post('/user/login', 'Api\UserController@login');
Route::post('/user/register', 'Api\UserController@register');
//
//Route::resource('/todo', 'TodoController');
//Route::resource('/user', 'UserController');
