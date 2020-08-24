<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = ['kat_nama'];

    //Child
    public function detail_kategori()
    {
        return $this->hasMany('App\Model\DetailKategori','kat_id');
    }
}
