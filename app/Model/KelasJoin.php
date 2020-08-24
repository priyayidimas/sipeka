<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class KelasJoin extends Pivot
{
    protected $table = 'kelas_join';
    public $incrementing = true;

    //Many Many Child
    public function jawaban()
    {
        return $this->belongsToMany('App\Model\Materi')->using('App\Model\Jawaban');
    }
}
