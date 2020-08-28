<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Model\Kelas;
use App\Model\Kategori;
use App\Model\Materi;

class PublicController extends Controller
{
    public function semuaKelas()
    {
        $kls = Kelas::all();
        $kat = Kategori::all();
        // foreach ($acc as $k) {
        //     dd($k);
        // }
        return view('allclass',compact('kls','kat'));
    }

    public function library()
    {
        $m = Materi::where('statusfile','0')->get();
        $kat = Kategori::all();
        return view('perpus',compact('m','kat'));
    }
}
