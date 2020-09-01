<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Jawaban extends Pivot
{
    protected $table = 'jawaban';
    public $incrementing = true;

    public function review()
    {
        return $this->hasMany('App\Model\Review','jwb_id');
    }
}
