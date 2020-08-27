<?php

namespace App\Http\Controllers;

use App\Model\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Kelas;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mhs.home');
    }

    public function biodataAwal()
    {
        if(Auth::user()->level == 1)
            return redirect('dosen/pelengkapan-data');
        return view('mhs.biodata');
    }

    public function insertBiodataAwal(Request $req)
    {
       $mhs = new Mahasiswa;
       $mhs->fill($req->all());
       $mhs->peminatan($req->peminatan);
       $mhs->id_user = Auth::id();
       $mhs->save();

       return redirect('/mhs')->with(['msg' => 'Selamat Datang!', 'color' => 'success']);
    }

    public function joinkelas()
    {
        $userJoin = Auth::user()->join;
        foreach ($userJoin as $join) {
            dd($join);
        }
    }
}
