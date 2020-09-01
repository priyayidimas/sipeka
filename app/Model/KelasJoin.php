<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class KelasJoin extends Pivot
{
    protected $table = 'kelas_join';
    public $incrementing = true;
}
