<?php

namespace App\Http\Controllers;

use App\Model\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Model\DetailKategori;
use App\Model\Kelas;
use App\Model\Materi;
use App\Model\Jawaban;
use App\Model\KelasJoin;
use App\Model\KelasKolab;
use DB;

class DosenController extends Controller
{

    public function index()
    {
        return view('dosen.home');
    }

    public function biodataAwal()
    {
        if(Auth::user()->level == 0)
            return redirect('mhs/pelengkapan-data');
        return view('dosen.biodata');
    }

    public function insertBiodataAwal(Request $req)
    {
       $dosen = new Dosen;
       $dosen->fill($req->all());
       $dosen->id_user = Auth::id();
       $dosen->save();

       return redirect('/dosen')->with(['msg' => 'Selamat Datang!', 'color' => 'success']);
    }

    public function indexKelas()
    {
        $kelas = Kelas::where('dosen_id',Auth::user()->id)->get();
        return view('dosen.kelas.index',compact('kelas'));
    }

    public function tambahKelas()
    {
        $dkategori = DetailKategori::all();
        return view('dosen.kelas.create',compact('dkategori'));
    }

    public function storeKelas(Request $req)
    {
        $st = new Kelas();
        do {
            $cd = $st->generateCode();
            $cek = DB::table('kelas')->where('kelas_kode',$cd)->get();
        } while (!$cek);
        $st->fill($req->all());
        $st->kelas_kode = $cd;
        $st->dosen_id = Auth::id();
        $st->save();

        $cek_kode = DB::table('kelas')->where('kelas_kode',$cd)->value('id');

        $jdl = $req->judul; $dsc = $req->desc_materi; $jns = $req->jenis; $file = $req->filemodul; $idytb = $req->idytb; $sts = $req->statusfile;
        for ($i=0; $i < count($jdl) ; $i++) {
            if(!isset($file[$i])){
                $filename = null;
            }else{
                $filename = date("YmdHis").'.'.$file[$i]->getClientOriginalName();
            }
            $data = array(
                'id_kelas' => $cek_kode,'judul' => $jdl[$i],'desc' => $dsc[$i],'jenis' => $jns[$i],'idytb' => $idytb[$i],'filemodul' => $filename,'statusfile' => $sts[$i]
            );
            if(isset($file[$i])){
                $namefile=date("YmdHis").'_'.$file[$i]->getClientOriginalName();
                $file[$i]->storeAs('public/modul',$namefile);
            }
            $allData[] = $data;
        }
        Materi::insert($allData);
        return redirect('dosen/kelas')->with(['msg' => 'Berhasil membuat kelas', 'color' => 'success']);
    }

    public function editKelas($id)
    {
        $kls = Kelas::find($id);
        $dkategori = DetailKategori::all();
        return view('dosen.kelas.kelola',compact('kls','dkategori'));
    }

    public function updateKelas(Request $req, $id)
    {
        $st = Kelas::find($id);
        $st->fill($req->all());
        $st->status_kelas = $req->status_kelas;
        $st->save();
        return redirect()->route('editkelas',$id)->with(['msg' => 'Berhasil mengubah informasi kelas!', 'color' => 'success']);
    }

    public function deleteKelas(Request $req)
    {
        $kls = Kelas::find($req->idkelas);
        if($kls->materi()->count()){
            return redirect('dosen/kelas')->with(['msg' => 'Gagal menghapus kelas, hapus materi terlebih dahulu!', 'color' => 'danger']);
        }
        $kls->delete();
        return redirect('dosen/kelas')->with(['msg' => 'Berhasil menghapus kelas', 'color' => 'success']);
    }

    public function storeMateri(Request $req,$id)
    {
        $mat = new Materi();
        $mat->fill($req->all());
        if($req->hasFile('filemodul')){
            $namefile=date("YmdHis").'_'.$req->filemodul->getClientOriginalName();
            $req->filemodul->storeAs('public/modul',$namefile);
            $mat->filemodul = $namefile;
        }
        $mat->id_kelas = $id;
        $mat->save();
        return redirect()->route('editkelas',$id)->with(['msg' => 'Berhasil menambahkan materi!', 'color' => 'success']);
    }
    
    public function updateMateri(Request $req,$id)
    {
        $mat = Materi::find($req->idmateri);
        $oldback = $mat->filemodul;
        $mat->fill($req->all());
        if ($req->hasFile('filemodul')) {
            $namefile=date("YmdHis").'_'.$req->filemodul->getClientOriginalName();
            $req->filemodul->storeAs('public/modul',$namefile);
            $mat->filemodul = $namefile;
            if ($oldback != NULL) {
                Storage::delete('public/modul/'.$oldback);
            }
        }else if($oldback != null){
            $mat->filemodul = $oldback;
        }
        $mat->save();
        return redirect()->route('editkelas',$id)->with(['msg' => 'Berhasil merubah materi kelas!', 'color' => 'success']);
    }

    public function deleteMateri(Request $req, $id)
    {
        // hitung jumlah jawaban
        $c_jwb = Jawaban::where('id_materi',$req->idmateri)->count();
        if($c_jwb == 1){
            $cek = Jawaban::where('id_materi',$req->idmateri)->first(); // Mengambil satu data jawaban
        }else if($c_jwb > 1){
            $cek = Jawaban::where('id_materi',$req->idmateri)->get(); // Mengambil banyak data jawaban
        }

        if($c_jwb != 0){
            if ($c_jwb == 1) {
                if ($cek->jawaban_file != NULL) {
                    Storage::delete('public/jawaban/'.$del->attfile);
                }
                $cek->delete();
            }else if($c_jwb>1){
                foreach ($c_jwb as $k) {
                    $data[] = $k->id; // Memasukkan idjawaban yang terhubung dengan materi
                }
                for ($i=0; $i < count($data); $i++) {
                    $a = Jawaban::where('id',$data[$i])->get(); // mencari data dengan idjawaban yang sesuai
                    if (!empty($a)) {
                        if ($a->jawaban_file != NULL) {
                            Storage::delete('public/jawaban/'.$a->jawaban_file);
                        }
                        $a->delete();
                    }else{
                        break;
                    }
                }
            }
        }

        $mt = Materi::find($req->idmateri);
        if ($mt->filemodul != NULL) {
            Storage::delete('public/modul/'.$mt->filemodul);
        }
        $mt->delete();
        return redirect()->route('editkelas',$id)->with(['msg' => 'Berhasil menghapus materi kelas!', 'color' => 'success']);
    }
}
