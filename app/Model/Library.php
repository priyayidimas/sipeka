<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table = 'library';
    public $incrementing = true;

    public function detail_kategori()
    {
        return $this->belongsTo('App\Model\DetailKategori','kategori_id');
    }
}
