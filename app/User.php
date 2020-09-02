<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'google_id', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    //Child
    public function dosen()
    {
        return $this->hasOne('App\Model\Dosen','id_user');
    }

    public function mahasiswa()
    {
        return $this->hasOne('App\Model\Mahasiswa','id_user');
    }

    // Dosen Child
    public function kelas()
    {
        return $this->hasMany('App\Model\Kelas','dosen_id');
    }

    public function library()
    {
        return $this->hasMany('App\Model\Library','dosen_id');
    }

    public function review()
    {
        return $this->hasMany('App\Model\Jawaban','reviewer_id');
    }

    // Mahasiswa Child
    public function jawaban()
    {
        $pivot = [
            'id', 'jawaban_text', 'jawaban_file',
            'review','grade',
            'submitted_at', 'reviewed_at',
            'created_at','updated_at'
        ];
        return $this->belongsToMany(
            'App\Model\Materi',             // Model Target
            'jawaban',                      // Table Inter name
            'id_mhs',                      // Foreign Key -> Current Model
            'id_materi')                    // Foreitn Key -> Target Model
            ->using('App\Model\Jawaban')
            ->withPivot($pivot);
    }
    public function joinEvent()
    {
        $pivot = [
            'id', 'approval',
            'created_at','updated_at'
        ];
        return $this->belongsToMany(
            'App\Model\Event',              // Model Target
            'kelas_event_join',             // Table Inter name
            'id_mhs',                 // Foreign Key -> Current Model
            'id_event')                     // Foreitn Key -> Target Model
            ->using('App\Model\JoinEvent')
            ->withPivot($pivot);
    }

    // Many To Many Child
    public function join()
    {
        $pivot = ['id','progress','created_at','updated_at'];
        return $this->belongsToMany(
            'App\Model\Kelas',          // Model Target
            'kelas_join',               // Table Inter name
            'id_user',                  // Foreign Key -> Current Model
            'id_kelas')                 // Foreitn Key -> Target Model
            ->using('App\Model\KelasJoin')
            ->withPivot($pivot);
    }
    public function kolab()
    {
        $pivot = ['id', 'status', 'akses','created_at','updated_at'];
        return $this->belongsToMany(
            'App\Model\Kelas',          // Model Target
            'kelas_kolab',               // Table Inter name
            'id_user',                  // Foreign Key -> Current Model
            'id_kelas')                 // Foreitn Key -> Target Model
            ->using('App\Model\KelasKolab')
            ->withPivot($pivot);
    }

    // Grand Children
    public function materi()
    {
        return $this->hasManyThrough(
            'App\Model\Materi',         // Grand Child
            'App\Model\Kelas',          // Child
            'dosen_id',                 // Foreign key on Child table
            'id_kelas',                 // Foreign key on Grand Child Table
        );
    }


    public function event()
    {
        return $this->hasManyThrough(
            'App\Model\Event',          // Grand Child
            'App\Model\Kelas',          // Child
            'dosen_id',                 // Foreign key on Child table
            'id_kelas',                 // Foreign key on Grand Child Table
        );
    }
}
