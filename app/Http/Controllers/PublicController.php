<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Kelas;
use App\Model\Kategori;
use App\Model\Materi;
use App\User;

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

    public function semuaDosen()
    {
        $dosen = User::where('level','1')->get();

        if (Auth::check() && Auth::user()->level > 0) {
            $dosen = User::where('level','1')->where('id','<>',Auth::id())->get();
        }
        return view('alldosen',compact('dosen'));
    }

    public function library()
    {
        $m = Materi::where('statusfile','0')->get();
        $kat = Kategori::all();
        return view('perpus',compact('m','kat'));
    }

    public function detailDosen($id)
    {
        $dosen = User::find($id);
        return view('detaildosenpub', compact('dosen'));
    }
}
