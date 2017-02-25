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
Route::get('/pricing', function(){
    return view('pages.pricing');
})->name('pages.pricing');
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

Route::get('/jobs/watching', 'JobController@watching')->name('jobs.watching');
Route::get('/jobs/interest', 'JobController@interest')->name('jobs.interest');
Route::get('/jobs/shortlist', 'JobController@shortlist')->name('jobs.shortlist');

Route::resource('/jobs', 'JobController');
Route::post('/jobs/upload_photo', 'JobController@upload_photo')->name('jobs.upload_photo');
Route::post('/jobs/delete_photo', 'JobController@delete_photo')->name('jobs.delete_photo');
Route::post('/jobs/move_watching/{job_id}', 'JobController@moveWatching')->name('jobs.move_watching');
Route::post('/jobs/delete_watching/{job_id}', 'JobController@deleteWatching')->name('jobs.delete_watching');
Route::post('/jobs/move_interest/{job_id}', 'JobController@moveInterest')->name('jobs.move_interest');
Route::post('/jobs/delete_interest/{job_id}', 'JobController@deleteInterest')->name('jobs.delete_interest');
Route::post('/jobs/move_shortlist/{job_id}', 'JobController@moveShortlist')->name('jobs.move_shortlist');
Route::post('/jobs/delete_shortlist/{job_id}', 'JobController@deleteShortlist')->name('jobs.delete_shortlist');

Route::resource('/job_questions', 'JobQuestionController', ['only' => ['store', 'show']]);
Route::resource('/job_questions.answers', 'JobAnswerController', ['only' => ['index', 'store']]);

//Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
Route::resource('/account', 'AccountController', ['only' => ['index', 'store']]);
Route::get('/account/edit', 'AccountController@edit')->name('account.edit');
Route::get('/account/contact_details', 'AccountController@edit_contact')->name('account.edit_contact');
Route::post('/account/update_contact_details', 'AccountController@update')->name('account.update');
Route::get('/account/add_funds1', function(){
    return view('account.add_funds1');
})->name('account.add_funds1');
Route::get('/account/add_funds2', function(){
    return view('account.add_funds2');
})->name('account.add_funds2');
Route::get('/account/add_funds3', function(){
    return view('account.add_funds3');
})->name('account.add_funds3');
// Catch all undefined routes. Always gotta stay at the bottom since order of routes matters.
//Route::any('{undefinedRoute}', function ($undefinedRoute) {
//    return view('layout');
//})->where('undefinedRoute', '([A-z\d-\/_.]+)?');

Route::get('users/{slug}', 'UserController@profile')->name('users.profile');
Route::post('users/express_interest/{id}', 'UserController@expressInterest')->name('users.express_interest');
Route::post('users/express_shortlist/{id}', 'UserController@expressShortlist')->name('users.express_shortlist');
Route::post('users/express_select/{id}', 'UserController@expressSelect')->name('users.express_select');
Route::get('users/tagged_users/{tag}', 'UserController@taggedUsers')->name('users.tagged_users');
Route::post('users/delete_tagged/{id}/{tag}', 'UserController@deleteTagged')->name('users.delete_tagged');

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
