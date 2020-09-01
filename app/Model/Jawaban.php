<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Jawaban extends Pivot
{
    protected $table = 'jawaban';
    public $incrementing = true;
    protected $fillable = [
        'review','grade','jawaban_file','jawaban_file'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo('App\User', 'id_mhs');
    }
    public function reviewer()
    {
        return $this->belongsTo('App\User', 'reviewer_id');
    }
    public function materi()
    {
        return $this->belongsTo('App\Model\Materi', 'id_materi');
    }
}
