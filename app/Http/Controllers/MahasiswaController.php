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
use App\Model\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;

class MahasiswaController extends Controller
{
    public function index()
    {

        // Cards
        $cKelas = Auth::user()->join()->count();
        $cSelesai = Auth::user()->join()->where('progress','100')->count();
        $cProgress = Auth::user()->join()->where('progress','<','100')->count();

        // Kelas
        $kelas = Auth::user()->join;

        $bio = Auth::user()->mahasiswa;
        return view('mhs.home',compact('cKelas','cSelesai','cProgress','kelas','bio'));
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
        $user = Auth::id();
        $n = Jawaban::where('id_mhs',$user);
        if ($n->count() > 0) {
            if($n->first()->jawaban_file)
                Storage::delete('public/jawaban/'.$n->first()->jawaban_file);
        }
        $nj = Jawaban::firstOrNew(['id_mhs' => $user, 'id_materi' => $req->idm]);
        $nj->id_mhs = $user;
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

    public function joinEvent($event_id, $mhs_id)
    {
        $event = Event::find($event_id);
        $mulai = Carbon::parse($event->waktu_mulai);
        $selesai = Carbon::parse($event->waktu_selesai);
        $cek = $this->cekJoinEvent($mulai, $selesai,$event_id);
        if($cek){
            $event->joinEvent()->attach($mhs_id);
            return redirect($event->link);
        }
        return back()->with(['color' => 'danger', 'msg' => 'Bentrok Dengan Jadwal lain']);
    }

    public function cekJoinEvent($mulai_data, $akhir_data, $notId){

        $kelasEvent = [];
        $kelas = Auth::user()->join;
        foreach($kelas as $kel){
            $event = $kel->event()
            ->where('id','<>',$notId)
            ->where(function ($query) use ($mulai_data, $akhir_data){
                $mulai = Carbon::now()->setTimezone('Asia/Jakarta')->addMinutes(-30);

                $query->whereBetween('waktu_mulai',[$mulai, $mulai_data])
                      ->orWhereBetween('waktu_selesai', [$mulai_data,$akhir_data]);
            })
            ->get();
            array_push($kelasEvent, $event);
        }
        $count = [];
        foreach($kelasEvent as $events){
            foreach($events as $event){
                $joinEvent = $event->joinEvent;
                array_push($count, count($joinEvent));
            }
        }

        $cek = (array_sum($count) == 0) ? true : false;
        return $cek;
    }

    public function profile()
    {
        $usr = User::find(Auth::user()->id);
        $kat = Kategori::all();
        return view('profileuser',compact('usr','kat'));
    }

    public function editprofile(Request $req)
    {
        $usr = User::find($req->usr);
        $usr->fullname = $req->nama;
        $usr->save();
        $bio = Mahasiswa::where('id_user',$req->usr)->first();
        $bio->prodi = $req->prodi;
        $bio->nim = $req->nim;
        $bio->univ = $req->univ;
        $pem = $req->peminatan;
        $bio->id_peminatan1 = $pem[0];
        $bio->id_peminatan2 = $pem[1];
        $bio->id_peminatan3 = $pem[2];
        $bio->save();
        return redirect()->back()->with(['msg' => 'Berhasil menupdate profile!', 'color' => 'success']);
    }

    public function cetakSertifikat()
    {
        $user = Auth::user();
        $kelas = Kelas::find(23);

        $pdf = PDF::loadView('layouts.sertifikat', compact('user','kelas'))
                    ->setPaper('a4', 'landscape');
        return $pdf->download('Sertifikat_'.$kelas->kelas_kode.'_'.$user->fullname.'.pdf');
    }
}
