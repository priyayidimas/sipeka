<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'kelas_materi';

    protected $fillable = [
        'judul', 'desc',
        'jenis', 'idytb',
        'filemodul', 'statusfile',
        'judul_modul'
    ];

    //Parent
    public function kelas()
    {
        return $this->belongsTo('App\Model\Kelas','id_kelas');
    }

    //Many Many Child
    public function jawaban()
    {
        $pivot = [
            'id', 'jawaban_text', 'jawaban_file',
            'submitted_at', 'grade',
            'created_at','updated_at'
        ];
        return $this->belongsToMany(
            'App\User',          // Model Target
            'jawaban',                      // Table Inter name
            'id_materi',                    // Foreign Key -> Current Model
            'id_mhs')                 // Foreitn Key -> Target Model
            ->using('App\Model\Jawaban')
            ->withPivot($pivot);
    }
}
