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
Route::group(['prefix' => 'legals'], function () {
    Route::view('privacy-policy', 'legal.privacy_policy');
    Route::view('terms-of-service', 'legal.terms_of_service');
});

Route::get('dashboard', 'UserController@index');

Route::get('login/{akses}', 'UserController@redirectToProvider');
Route::get('glogin', 'UserController@handleProviderCallback');

Route::get('logout', 'UserController@logout');

Route::get('invitation/accepted/{kelas_id}/{akses}/{user_id}', 'UserController@invite');

Route::view('chat', 'layouts.telegram');

Route::group(['prefix' => 'dosen', 'middleware' => ['auth']], function () {

    Route::get('pelengkapan-data', 'DosenController@biodataAwal');
    Route::post('pelengkapan-data', 'DosenController@insertBiodataAwal');

    Route::group(['middleware' => ['dosen']], function () {
        Route::get('/', 'DosenController@index');
        Route::get('daftar-dosen', 'DosenController@dosenList');

        Route::get('profile', 'DosenController@profile')->name('profdsn');
        Route::put('profile-store', 'DosenController@editprofile')->name('storprofdsn');

        Route::group(['prefix' => 'perpustakaan'], function () {
            Route::get('/', 'DosenController@library')->name('library');
            Route::post('/store', 'DosenController@storemodul')->name('storemod');
        });
        Route::post('invite', 'DosenController@invite');

        // Kelas
        Route::group(['prefix' => 'kelas'], function () {
            Route::get('/', 'DosenController@indexKelas');
            Route::get('tambah', 'DosenController@tambahKelas');
            Route::post('store', 'DosenController@storeKelas')->name('storekelas');
            Route::get('kelola/{id}', 'DosenController@editKelas')->name('editkelas');
            Route::put('update/{id}', 'DosenController@updateKelas')->name('updatekelas');
            Route::post('delete', 'DosenController@deleteKelas')->name('hapuskelas');

            Route::get('submission/{id}', 'DosenController@listSub')->name('listsubmis');
            Route::get('list-submission/{id}', 'DosenController@listMateriSub')->name('listmhssubmis');
            Route::get('periksa/{id}', 'DosenController@periksa')->name('periksa');
        });

        Route::group(['prefix' => 'materi'], function () {
            Route::post('store/{id}', 'DosenController@storeMateri')->name('storemat');
            Route::put('update/{id}', 'DosenController@updateMateri')->name('updatemat');
            Route::post('delete/{id}', 'DosenController@deleteMateri')->name('deletemat');
        });

        Route::group(['prefix' => 'events'], function () {
            Route::post('store', 'CalendarController@storeEvent')->name('storeEvent');
            Route::post('patch', 'CalendarController@patchEvent')->name('patchEvent');
            Route::get('delete/{id}', 'CalendarController@deleteEvent')->name('deleteEvent');
        });
    });

});

Route::group(['prefix' => 'mhs', 'middleware' => ['auth']], function () {

    Route::get('pelengkapan-data', 'MahasiswaController@biodataAwal');
    Route::post('pelengkapan-data', 'MahasiswaController@insertBiodataAwal');

    Route::group(['middleware' => ['mahasiswa']], function () {
        Route::get('/', 'MahasiswaController@index');
        Route::get('profile', 'MahasiswaController@profile')->name('profmhs');
        Route::put('profile-store', 'MahasiswaController@editprofile')->name('storprofmhs');

        Route::get('perpustakaan', function () { return redirect('perpustakaan'); });

        Route::group(['prefix' => 'kelas'], function () {
            Route::get('/', 'MahasiswaController@indexKelas');
            Route::post('join-kelas', 'MahasiswaController@joinKelas')->name('jkelas');
            Route::get('/lihat-kelas/{id}', 'MahasiswaController@lihatKelas')->name('lihat-kelas');
            Route::get('/materi/{idkelas}/{id}', 'MahasiswaController@lihatMateri')->name('lmateri');

            Route::post('jawaban/{id}', 'MahasiswaController@jawabMateri')->name('jmateri');
            Route::post('jawaban/edit/', 'MahasiswaController@jawabEdit')->name('jedit');
        });

        Route::group(['prefix' => 'event'], function () {
            Route::get('{event_id}/join/{join_id}', 'MahasiswaController@joinEvent');
        });
    });

});

Route::group(['prefix' => 'admin' ,'middleware' => ['auth','admin']], function () {
    Route::get('/', 'AdminController@index');

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', 'AdminController@kategori');
        Route::post('/', 'KategoriController@insertKategori');
    });
});

// Public View
Route::get('daftar-kelas', 'PublicController@semuaKelas')->name('ikelas');
Route::get('daftar-dosen', 'PublicController@semuaDosen')->name('idosen');
Route::get('perpustakaan', 'PublicController@library')->name('library');
Route::get('detail-dosen/{id}', 'PublicController@detailDosen')->name('detaildosen');



// Debug
Route::get('debug', function () {
    return view('layouts.sertifikat');
});
Route::post('debug/kategori', 'KategoriController@insertKategori');
Route::post('debug/dkategori', 'KategoriController@insertDetailKategori');

Route::get('calendars', 'CalendarController@calendars');
Route::get('joinkelas', 'MahasiswaController@joinkelas');
Route::get('mail', 'UserController@mail');


Route::get('calendar', 'CalendarController@calendar');
Route::get('events', 'CalendarController@getEvents');
Route::get('people', 'CalendarController@getPeople');

Route::get('meet', 'CalendarController@createEventConference');
