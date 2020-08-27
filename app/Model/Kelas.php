<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = ['kelas_nama', 'desc', 'dkat_id', 'link_tel'];

    public function generateCode() {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $this->kelas_kode = $randomString;
        return $this->kelas_kode;
    }

    //Parent
    public function dosen()
    {
        return $this->belongsTo('App\User','dosen_id');
    }

    public function detail_kategori()
    {
        return $this->belongsTo('App\Model\DetailKategori','dkat_id');
    }

    //Child
    public function materi()
    {
        return $this->hasMany('App\Model\Materi','id_kelas');
    }

    public function event()
    {
        return $this->hasMany('App\Model\Event','id_kelas');
    }

    public function kelas()
    {
        return $this->hasMany('App\Model\KelasJoin', 'id_kelas');
    }

    // Many To Many Child
    public function join()
    {
        $pivot = ['id','progress','created_at','updated_at'];
        return $this->belongsToMany(
            'App\User',          // Model Target
            'kelas_join',               // Table Inter name
            'id_kelas',                  // Foreign Key -> Current Model
            'id_user')                 // Foreitn Key -> Target Model
            ->using('App\Model\KelasJoin')
            ->withPivot($pivot);
    }
    public function kolab()
    {
        $pivot = ['id', 'status', 'akses','created_at','updated_at'];
        return $this->belongsToMany(
            'App\User',          // Model Target
            'kelas_join',               // Table Inter name
            'id_kelas',                  // Foreign Key -> Current Model
            'id_user')                 // Foreitn Key -> Target Model
            ->using('App\Model\KelasKolab')
            ->withPivot($pivot);
    }
}
