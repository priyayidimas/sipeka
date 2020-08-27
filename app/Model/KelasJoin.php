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
        $pivot = [
            'id', 'jawaban_text', 'jawaban_file',
            'review', 'grade', 'reviewer_id',
            'submitted_at', 'reviewed_at',
            'created_at','updated_at'
        ];
        return $this->belongsToMany(
            'App\Model\Materi',             // Model Target
            'jawaban',                      // Table Inter name
            'id_joinkelas',                 // Foreign Key -> Current Model
            'id_materi')                    // Foreitn Key -> Target Model
            ->using('App\Model\Jawaban')
            ->withPivot($pivot);
    }
    public function joinEvent()
    {
        $pivot = [
            'id', 'approval',
            'created_at','updated_at'
        ];
        return $this->belongsToMany(
            'App\Model\Event',              // Model Target
            'kelas_event_join',             // Table Inter name
            'id_joinkelas',                 // Foreign Key -> Current Model
            'id_event')                     // Foreitn Key -> Target Model
            ->using('App\Model\JoinEvent')
            ->withPivot($pivot);
    }
}
