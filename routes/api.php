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
    Route::post('/user/social_login', 'Api\UserController@socialLogin');

    Route::get('/account/edit/{id}', 'Api\AccountController@edit');
    Route::post('/account/store', 'Api\AccountController@store');
    Route::post('/account/contact_detail', 'Api\AccountController@update');

    Route::post('/jobs/categories', 'Api\JobController@getCategories');
    Route::post('/jobs/locations', 'Api\JobController@getLocations');
    Route::post('/jobs/{id}/{category_id}/{location_id}', 'Api\JobController@jobs');
    Route::post('/jobs/upload_photo', 'Api\JobController@uploadJobPhoto');
    Route::post('/jobs/store', 'Api\JobController@store');


    Route::post('/jobs/mine/{id}', 'Api\JobController@mine');
    Route::post('/jobs/previous/{id}', 'Api\JobController@previous');
    Route::get('/jobs/watching/{id}', 'Api\JobController@watching');
    Route::get('/jobs/interested/{id}', 'Api\JobController@interest');
    Route::get('/jobs/shortlisted/{id}', 'Api\JobController@shortlist');
    Route::post('/jobs/close_listing/{id}', 'Api\JobController@closeListing');

    Route::get('/jobs/{job_id}/{user_id} ', 'Api\JobController@show');

    Route::post('/jobs/move_watching', 'Api\JobController@moveWatching');
    Route::post('/jobs/express_interest', 'Api\JobController@expressInterest');
    Route::post('/jobs/express_shortlist/{id}', 'Api\JobController@expressShortlist');
    Route::post('/jobs/express_select/{id}', 'Api\JobController@expressSelect');
    Route::get('/jobs/tagged_users/{id}/{tag}', 'Api\JobController@taggedUsers');
    Route::post('/jobs/delete_tagged/{id}/{tag}', 'Api\JobController@deleteTagged');

    Route::get('/user/notifications/{id}', 'Api\UserController@notification');

});
//
//Route::resource('/todo', 'TodoController');
//Route::resource('/user', 'UserController');
