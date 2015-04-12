<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// in RouteServiceProvider.php pattern doesn't work
Route::pattern('id', '[0-9]+');
Route::pattern('num', '\b\d+\.\d{2}'); // eg. 120.50

Route::get('test/{var}', 'HomeController@test');

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::post('home', 'HomeController@post_action');
Route::get('account', 'HomeController@account');
Route::get('about', function () {
    return view('about');
});
Route::get('contact', function () {
    return view('contact');
});
Route::get('help', function () {
    return view('help');
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
