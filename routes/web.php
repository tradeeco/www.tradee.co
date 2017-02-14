<?php
use Illuminate\Support\Facades\Auth;
use App\S_R_relation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index')->name('root');

Route::get('/partials/index', function () {
    return view('partials.index');
});

Route::get('/partials/{category}/{action?}', function ($category, $action = 'index') {
    return view(join('.', ['partials', $category, $action]));
});

Route::get('/partials/{category}/{action}/{id}', function ($category, $action = 'index', $id) {
    return view(join('.', ['partials', $category, $action]));
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home.index');

Route::post('/api/login', 'Auth\LoginController@ajaxLogin');

Route::resource('/jobs', 'JobController');
Route::post('/jobs/upload_photo', 'JobController@upload_photo')->name('jobs.upload_photo');
Route::post('/jobs/delete_photo', 'JobController@delete_photo')->name('jobs.delete_photo');

Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
// Catch all undefined routes. Always gotta stay at the bottom since order of routes matters.
//Route::any('{undefinedRoute}', function ($undefinedRoute) {
//    return view('layout');
//})->where('undefinedRoute', '([A-z\d-\/_.]+)?');


Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});
