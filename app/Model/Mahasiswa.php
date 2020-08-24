<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mhs_biodata';

    protected $fillable = ['nim', 'nohp', 'prodi','univ'];

    public function peminatan($arrPeminatan)
    {
        $this->id_peminatan1 = $arrPeminatan[0];
        $this->id_peminatan2 = $arrPeminatan[1];
        $this->id_peminatan3 = $arrPeminatan[2];
    }

    //Parent
    public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }

    //Child
    public function minat_1()
    {
        return $this->hasOne('App\Model\DetailKategori','peminatan1');
    }

    public function minat_2()
    {
        return $this->hasOne('App\Model\DetailKategori','peminatan2');
    }

    public function minat_3()
    {
        return $this->hasOne('App\Model\DetailKategori','peminatan3');
    }
}
