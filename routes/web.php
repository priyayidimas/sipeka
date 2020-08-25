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

Route::get('calendar', 'CalendarController@calendar');
Route::get('events', 'CalendarController@getEvents');
Route::get('people', 'CalendarController@getPeople');

Route::get('meet', 'CalendarController@createEventConference');

Route::group(['prefix' => 'dosen', 'middleware' => ['auth']], function () {

    Route::get('pelengkapan-data', 'DosenController@biodataAwal');
    Route::post('pelengkapan-data', 'DosenController@insertBiodataAwal');

    // Kelas
    Route::get('kelas', 'DosenController@indexKelas');
    Route::get('kelas/tambah', 'DosenController@tambahKelas');
    Route::post('kelas/store', 'DosenController@storeKelas')->name('storekelas');

    Route::group(['middleware' => ['dosen']], function () {
        Route::get('/', 'DosenController@index');
    });

});

Route::group(['prefix' => 'mhs', 'middleware' => ['auth']], function () {

    Route::get('pelengkapan-data', 'MahasiswaController@biodataAwal');
    Route::post('pelengkapan-data', 'MahasiswaController@insertBiodataAwal');

    Route::group(['middleware' => ['mahasiswa']], function () {
        Route::get('/', 'MahasiswaController@index');
    });

});

Route::group(['prefix' => 'admin' ,'middleware' => ['auth','admin']], function () {
    Route::get('/', 'AdminController@index');

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', 'AdminController@kategori');
        Route::post('/', 'KategoriController@insertKategori');
    });
});

Route::get('list-kelas', function () {
    return view('allclass');
});

Route::get('debug', function () {
    return view('debug');
});
Route::post('debug/kategori', 'KategoriController@insertKategori');
Route::post('debug/dkategori', 'KategoriController@insertDetailKategori');

