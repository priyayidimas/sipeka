<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class KelasKolab extends Pivot
{
    protected $table = 'kelas_kolab';
    public $incrementing = true;
}
