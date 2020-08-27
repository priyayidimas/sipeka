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

    //Many Many Child
    public function jawaban()
    {
        $pivot = [
            'id', 'jawaban_text', 'jawaban_file',
            'review', 'grade', 'reviewer_id',
            'submitted_at', 'reviewed_at',
            'created_at','updated_at'
        ];
        return $this->belongsToMany(
            'App\Model\KelasJoin',          // Model Target
            'jawaban',                      // Table Inter name
            'id_materi',                    // Foreign Key -> Current Model
            'id_joinkelas')                 // Foreitn Key -> Target Model
            ->using('App\Model\Jawaban')
            ->withPivot($pivot);
    }
}
