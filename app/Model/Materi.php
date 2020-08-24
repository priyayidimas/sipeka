<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'kelas_materi';

    protected $fillable = [
        'judul', 'desc',
        'jenis', 'idytb',
        'filemodul', 'statusfile'
    ];

    //Parent
    public function kelas()
    {
        return $this->belongsTo('App\Kelas','id_kelas');
    }
}
