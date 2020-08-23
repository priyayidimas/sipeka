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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', 'UserController@index');

Route::get('login', 'UserController@redirectToProvider');
Route::get('glogin', 'UserController@handleProviderCallback');

Route::get('logout', 'UserController@logout');

Route::get('events', 'CalendarController@getEvents');
Route::get('people', 'CalendarController@getPeople');

Route::get('meet', 'CalendarController@createEventConference');

Route::group(['prefix' => 'dosen'], function () {
    Route::get('/', function (){ return view('dosen.home'); });
    Route::get('pelengkapan-data', function (){ return view('dosen.biodata'); });
});

Route::group(['prefix' => 'mhs'], function () {
    Route::get('/', function (){ return view('mhs.home'); });
    Route::get('pelengkapan-data', function (){ return view('mhs.biodata'); });
});
