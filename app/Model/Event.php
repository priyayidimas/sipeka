<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'kelas_event';

    protected $fillable = ['title','desc'];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    //Parent
    public function kelas()
    {
        return $this->belongsTo('App\Model\Kelas','id_kelas');
    }

    public function joinEvent()
    {
        $pivot = [
            'id', 'approval',
            'created_at','updated_at'
        ];
        return $this->belongsToMany(
            'App\User',              // Model Target
            'kelas_event_join',                 // Table Inter name
            'id_event',                         // Foreign Key -> Current Model
            'id_mhs')                     // Foreign Key -> Target Model
            ->using('App\Model\JoinEvent')
            ->withPivot($pivot);
    }
}
