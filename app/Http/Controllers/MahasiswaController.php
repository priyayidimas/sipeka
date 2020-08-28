<?php

namespace App\Http\Controllers;

use App\Model\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\KelasJoin;
use App\Model\Kelas;
use App\Model\Materi;
use App\User;
use App\Model\Jawaban;
use App\Model\Kategori;

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
        $kls = Auth::user()->join;
        return view('mhs.kelas.index',compact('kls'));
    }
    
    public function semuaKelas()
    {
        $kls = Kelas::all();
        $acc = Auth::user()->join;
        $kat = Kategori::all();
        // foreach ($acc as $k) {
        //     dd($k);
        // }
        return view('allclass',compact('kls','acc','kat'));
    }

    public function joinKelas(Request $req)
    {
        $cek = KelasJoin::where('id_kelas',$req->idkelas)->where('id_user',Auth::user()->id)->count();
        if (Auth::check() && $cek == 0) {
            $jkelas = new KelasJoin();
            $jkelas->id_user = Auth::user()->id;
            $jkelas->id_kelas = $req->idkelas;
            $jkelas->save();
            return redirect()->route('ikelas')->with(['msg' => 'Berhasil bergabung ke kelas!', 'color' => 'success']);
        }else if ($cek > 0) {
            return redirect()->back()->with(['msg' => 'Anda sudah bergabung ke dalam kelas!', 'color' => 'warning']);
        }else{
            return redirect()->back()->with(['msg' => 'Login sebelum bergabung ke kelas!', 'color' => 'danger']);
        }
    }

    public function lihatKelas($id)
    {
        $kls = Kelas::where('kelas_kode',$id)->first();
        $mt = Materi::where('id_kelas',$kls->id)->get();
        return view('mhs.kelas.detail',compact('kls','mt'));
    }

    public function lihatMateri($idkelas,$id)
    {
        $kls = Kelas::where('kelas_kode',$idkelas)->first();
        $mt = Materi::where('id_kelas',$kls->id)->get();
        // $join = Auth::user()->join;
        // dd($join);
        $show = Materi::find($id);
        return view('mhs.kelas.materi',compact('mt','id','kls','show'));
    }

    public function jawabMateri(Request $req,$id)
    {
        $join = KelasJoin::where('id_kelas',$id)->where('id_user', Auth::user()->id)->first();
        if ($n = Jawaban::where('id_joinkelas',$join->id)->count() > 0) {
            if($n->jawaban_file)
                Storage::delete('public/jawaban/'.$n->jawaban_file);
            $n->delete();
        }
        $nj = new Jawaban();
        $nj->id_joinkelas = $join->id;
        $nj->id_materi = $req->idm;
        $nj->jawaban_text = $req->jawab_text;
        if($req->hasFile('jawab_file')){
            $namefile=date("YmdHis").'_'.$req->jawab_file->getClientOriginalName();
            $req->jawab_file->storeAs('public/jawaban',$namefile);
            $nj->jawaban_file = $namefile;
        }
        $nj->save();

        return redirect()->back()->with(['msg' => 'Jawaban berhasil disimpan!', 'color' => 'success']);
    }
}
