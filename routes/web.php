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

    Route::group(['middleware' => ['dosen']], function () {
        Route::get('/', 'DosenController@index');

        // Kelas
        Route::group(['prefix' => 'kelas'], function () {
            Route::get('/', 'DosenController@indexKelas');
            Route::get('tambah', 'DosenController@tambahKelas');
            Route::post('store', 'DosenController@storeKelas')->name('storekelas');
            Route::get('kelola/{id}', 'DosenController@editKelas')->name('editkelas');
            Route::put('update/{id}', 'DosenController@updateKelas')->name('updatekelas');
            Route::post('delete', 'DosenController@deleteKelas')->name('hapuskelas');
        });

        Route::group(['prefix' => 'materi'], function () {
            Route::post('store/{id}', 'DosenController@storeMateri')->name('storemat');
            Route::put('update/{id}', 'DosenController@updateMateri')->name('updatemat');
            Route::post('delete/{id}', 'DosenController@deleteMateri')->name('deletemat');
        });

        Route::group(['prefix' => 'events'], function () {
            Route::post('store', 'CalendarController@storeEvent');
        });
    });

});

Route::group(['prefix' => 'mhs', 'middleware' => ['auth']], function () {

    Route::get('pelengkapan-data', 'MahasiswaController@biodataAwal');
    Route::post('pelengkapan-data', 'MahasiswaController@insertBiodataAwal');

    Route::group(['prefix' => 'kelas'], function () {
        Route::get('/', 'MahasiswaController@indexKelas');
        Route::get('daftar-kelas', 'MahasiswaController@semuaKelas')->name('ikelas');
        Route::post('join-kelas', 'MahasiswaController@joinKelas')->name('jkelas');
    });

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

Route::get('list-dosen', function () {
    return view('alldosen');
});
Route::get('detail-list-dosen', function () {
    return view('detaildosenpub');
});

Route::get('debug', function () {
    return view('debug');
});
Route::post('debug/kategori', 'KategoriController@insertKategori');
Route::post('debug/dkategori', 'KategoriController@insertDetailKategori');

Route::get('calendars', 'CalendarController@calendars');

