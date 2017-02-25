<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');

Route::get('/', 'Admin\DashboardController@index');
Route::resource('/categories', 'Admin\CategoryController');
Route::resource('/locations', 'Admin\LocationController');
Route::resource('/dashboards', 'Admin\DashboardController');
Route::resource('/users', 'Admin\UserController');