<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class JoinEvent extends Pivot
{
    protected $table = 'kelas_event_join';
    public $incrementing = true;
}
