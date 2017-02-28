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
Route::group(['middleware' => 'cors'], function() {
    Route::post('/user/login', 'Api\UserController@login');
    Route::post('/user/register', 'Api\UserController@register');

    Route::get('/account/edit/{id}', 'Api\AccountController@edit');
    Route::post('/account/contact_detail', 'Api\AccountController@update');

    Route::post('/jobs/categories', 'Api\JobController@getCategories');
    Route::post('/jobs/locations', 'Api\JobController@getLocations');
    Route::post('/jobs/{id}/{category_id}/{location_id}', 'Api\JobController@jobs');
    Route::post('/jobs/upload_photo', 'Api\JobController@uploadJobPhoto');
    Route::post('/jobs/store', 'Api\JobController@store');
    Route::get('/jobs/{id}', 'Api\JobController@show');
    Route::post('/users/express_interest', 'Api\UserController@expressInterest');

});
//
//Route::resource('/todo', 'TodoController');
//Route::resource('/user', 'UserController');
