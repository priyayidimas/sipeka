<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailKategori extends Model
{
    protected $table = 'dkategori';

    protected $fillable = ['dkat_nama','kat_id'];

    //Parent
    public function kategori()
    {
        return $this->belongsTo('App\Model\Kategori','kat_id');
    }

    //Child
    public function kelas()
    {
        return $this->hasMany('App\Model\Kelas','dkat_id');
    }

    public function library()
    {
        return $this->hasMany('App\Model\Library','kategori_id');
    }
}
