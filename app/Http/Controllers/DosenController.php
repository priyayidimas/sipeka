<?php

namespace App\Http\Controllers;

use App\Model\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Model\DetailKategori;
use App\Model\Kelas;
use App\Model\Materi;
use DB;

class DosenController extends Controller
{

    public function index()
    {
        return view('dosen.home');
    }
    public function isiBiodata(Request $req)
    {
       $dosen = new Dosen;
       $dosen->fill($req->all());
       $dosen->id_user = Auth::id();
       $dosen->save();

       return redirect('/dosen')->with(['msg' => 'Selamat Datang!', 'color' => 'success']);
    }

    public function indexKelas()
    {
        $kelas = Kelas::all();
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
                $namefile=date("YmdHis").'.'.$file[$i]->getClientOriginalName();
                $file[$i]->storeAs('public/modul',$namefile);
            }
            $allData[] = $data;
        }
        Materi::insert($allData);
        return redirect('dosen/kelas')->with(['msg' => 'Berhasil membuat kelas', 'color' => 'success']);
    }
}
