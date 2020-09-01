<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Review extends Pivot
{
    protected $table = 'jwb_review';
    public $incrementing = true;

    public function jawaban()
    {
        return $this->belongsTo('App\Model\Jawaban','jwb_id');
    }

    public function reviewer()
    {
        return $this->belongsTo('App\User','reviewer_id');
    }
}
