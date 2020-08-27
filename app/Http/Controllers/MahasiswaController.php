<?php

namespace App\Http\Controllers;

use App\Model\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\KelasJoin;
use App\Model\Kelas;
use App\User;

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

    public function indexKelas()
    {
        $kls = User::find(Auth::user()->id);
        return view('mhs.kelas.index',compact('kls'));
    }

    public function semuaKelas()
    {
        $kls = Kelas::all();
        return view('allclass',compact('kls'));
    }

    public function joinKelas(Request $req)
    {
        if (Auth::check()) {
            $jkelas = new KelasJoin();
            $jkelas->id_user = Auth::user()->id;
            $jkelas->id_kelas = $req->idkelas;
            $jkelas->save();
            return redirect()->route('ikelas')->with(['msg' => 'Berhasil bergabung ke kelas!', 'color' => 'success']);
        }else{
            return redirect()->back()->with(['msg' => 'Login sebelum bergabung ke kelas!', 'color' => 'danger']);;
        }
    }
}
