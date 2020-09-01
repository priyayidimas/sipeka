<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Jawaban extends Pivot
{
    protected $table = 'jawaban';
    public $incrementing = true;

    public function reviewer()
    {
        return $this->belongsTo('App\User', 'reviewer_id');
    }
}
