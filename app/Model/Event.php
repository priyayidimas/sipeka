<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'kelas_event';

    protected $fillable = ['desc', 'waktu'];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    //Parent
    public function kelas()
    {
        return $this->belongsTo('App\Kelas','id_kelas');
    }
}
