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

Route::get('login/{akses}', 'UserController@redirectToProvider');

Route::get('glogin', 'UserController@handleProviderCallback');

Route::get('logout', 'UserController@logout');

Route::get('events', 'CalendarController@getEvents');
Route::get('people', 'CalendarController@getPeople');

Route::get('meet', 'CalendarController@createEventConference');

Route::group(['prefix' => 'dosen', 'middleware' => 'auth'], function () {

    Route::get('pelengkapan-data', function (){ return view('dosen.biodata'); });
    Route::post('pelengkapan-data', 'DosenController@isiBiodata');

    Route::group(['middleware' => ['dosen']], function () {
        Route::get('/', 'DosenController@index');
    });

});

Route::group(['prefix' => 'mhs', 'middleware' => 'auth', 'mahasiswa'], function () {

    Route::get('pelengkapan-data', function (){ return view('mhs.biodata'); });
    Route::post('pelengkapan-data', 'MahasiswaController@isiBiodata');

    Route::group(['middleware' => ['mahasiswa']], function () {
        Route::get('/', 'MahasiswaController@index');
    });

});

Route::get('debug', function () {

    dd(\App\User::find(4)->dosen()->count());

});
