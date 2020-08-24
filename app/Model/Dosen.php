<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dsn_biodata';

    protected $fillable = ['nidn', 'prodi', 'univ','nohp'];

    //Parent
    public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }

}
