<?php
use Illuminate\Support\Facades\Auth;
use App\S_R_relation;

Route::pattern('slug',           '[a-zA-Z0-9-]+');
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

Route::get('/contact', 'WelcomeController@contact')->name('pages.contact');
Route::post('/post_contact', 'WelcomeController@postContact')->name('pages.post_contact');
Route::get('/story', 'WelcomeController@story')->name('pages.story');
Route::get('/about_us', 'WelcomeController@aboutUs')->name('pages.about_us');
//Route::get('/partials/{category}/{action?}', function ($category, $action = 'index') {
//    return view(join('.', ['partials', $category, $action]));
//});
//
//Route::get('/partials/{category}/{action}/{id}', function ($category, $action = 'index', $id) {
//    return view(join('.', ['partials', $category, $action]));
//});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home.index');

Route::post('/api/login', 'Auth\LoginController@ajaxLogin');

Route::resource('/jobs', 'JobController');
Route::post('/jobs/upload_photo', 'JobController@upload_photo')->name('jobs.upload_photo');
Route::post('/jobs/delete_photo', 'JobController@delete_photo')->name('jobs.delete_photo');

//Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
Route::resource('/account', 'AccountController', ['only' => ['index', 'store']]);
Route::get('/account/edit', 'AccountController@edit')->name('account.edit');
Route::get('/account/contact_details', 'AccountController@edit_contact')->name('account.edit_contact');
Route::post('/account/update_contact_details', 'AccountController@update')->name('account.update');
// Catch all undefined routes. Always gotta stay at the bottom since order of routes matters.
//Route::any('{undefinedRoute}', function ($undefinedRoute) {
//    return view('layout');
//})->where('undefinedRoute', '([A-z\d-\/_.]+)?');

Route::get('users/{slug}', 'UserController@profile')->name('users.profile');


Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout');

//  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm');
//  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});
