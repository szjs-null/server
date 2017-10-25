<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

\View::addExtension('html', 'php');

Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('index');
});
Route::get('/register', function () {
    return view('index');
});
Route::get('/home', function () {
    return view('index');
});


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::resource('users', 'UserController');
//Route::resource('session', 'SessionController');
//
//Route::post('/login', 'SessionController@store');

Route::post('/api/code', 'CodeController@store');
Route::post('/api/reg', 'Auth\\RegisterController@store');
Route::post('/api/login', 'Auth\\LoginController@store');
