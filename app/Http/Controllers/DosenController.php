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
use App\Model\Library;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DosenController extends Controller
{
    public function index()
    {
        // Cards
        $cKelas = Auth::user()->kelas()->count();
        $cPublik = Auth::user()->materi()->where('statusfile','0')->count();
        $cPrivate = Auth::user()->materi()->where('statusfile','1')->count();

        // Events
        $events = Auth::user()->event()->get();

        // Invitation
        $kelas = Auth::user()->kelas;

        return view('dosen.home',compact('cKelas','cPublik','cPrivate','events','kelas'));
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

        $jdl = $req->judul; $dsc = $req->desc_materi; $jns = $req->jenis; $file = $req->filemodul; $idytb = $req->idytb; $sts = $req->statusfile;$jdlmodul = $req->judul_modul;
        for ($i=0; $i < count($jdl) ; $i++) {
            if(!isset($file[$i])){
                $filename = null;
            }else{
                $filename = date("YmdHis").'.'.$file[$i]->getClientOriginalName();
            }
            $data = array(
                'id_kelas' => $cek_kode,'judul' => $jdl[$i],'desc' => $dsc[$i],'jenis' => $jns[$i],'idytb' => $idytb[$i],'filemodul' => $filename,'statusfile' => $sts[$i],'judul_modul' => $jdlmodul[$i]
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

            // Library
            $kelas = Kelas::find($id);
            if($mat->statusfile == 0){
                $lib = new Library();
                $lib->judul = $req->judul_modul;
                $lib->filename = $namefile;
                $lib->dosen_id = $kelas->dosen->id;
                $lib->kategori_id = $kelas->dkat_id;
                $lib->save();
            }
        }
        $mat->id_kelas = $id;
        $mat->save();

        return redirect()->route('editkelas',$id)->with(['msg' => 'Berhasil menambahkan materi!', 'color' => 'success']);
    }

    public function updateMateri(Request $req,$id)
    {
        $mat = Materi::find($req->idmateri);
        $oldback = $mat->filemodul;

        $old_lib = Library::where('judul',$mat->judul_modul)->where('filename',$oldback)->first();

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
        if ($req->statusfile == 0) {
            $lib = ($old_lib == null) ? new Library() : $old_lib;
            $lib->judul = $mat->judul_modul;
            $lib->filename = $mat->filemodul;
            $lib->dosen_id = $mat->kelas->dosen->id;
            $lib->kategori_id = $mat->kelas->dkat_id;
            $lib->save();
        }else{
            if($old_lib != null) $old_lib->delete();
        }
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
        if ($mt->statusfile == 0) {
            Library::where('judul',$mt->judul_modul)->where('filename',$mt->filemodul)->delete();
        }

        if ($mt->filemodul != NULL) {
            Storage::delete('public/modul/'.$mt->filemodul);
        }
        $mt->delete();
        return redirect()->route('editkelas',$id)->with(['msg' => 'Berhasil menghapus materi kelas!', 'color' => 'success']);
    }

    public function listSub($id)
    {
        $kls = Kelas::find($id);
        return view('dosen.kelas.listsubmis',compact('kls'));
    }

    public function listMateriSub($id)
    {
        $mt = Materi::find($id);
        return view('dosen.kelas.materisubmis',compact('mt'));
    }

    public function periksa($id)
    {
        return view('dosen.kelas.periksa');
    }

    public function profile()
    {
        $usr = User::find(Auth::user()->id);
        return view('profileuser',compact('usr'));
    }

    public function editprofile(Request $req)
    {
        $usr = User::find($req->usr);
        $usr->fullname = $req->nama;
        $usr->save();
        $bio = Dosen::where('id_user',$req->usr)->first();
        $bio->prodi = $req->prodi;
        $bio->nidn = $req->nidn;
        $bio->univ = $req->univ;
        $bio->save();
        return redirect()->back()->with(['msg' => 'Berhasil menupdate profile!', 'color' => 'success']);
    }

    public function library()
    {
        $lb = Library::all();
        $dk = DetailKategori::all();
        return view('dosen.perpustakaan.index',compact('lb','dk'));
    }

    public function storemodul(Request $req)
    {
        $lb = new Library();
        $lb->judul = $req->judul;
        $lb->kategori_id = $req->kategori_id;
        if($req->hasFile('namafile')){
            $namefile=date("YmdHis").'_'.$req->namafile->getClientOriginalName();
            $req->namafile->storeAs('public/modul',$namefile);
            $lb->filename = $namefile;
        }
        $lb->dosen_id = Auth::user()->id;
        $lb->save();
        return redirect()->back()->with(['msg' => 'Berhasil menambahkan modul!', 'color' => 'success']);
    }


    public function invite(Request $req)
    {
        $dosen_id = $req->dosen_id;
        $kelas_id = $req->kelas_id;

        $cek = KelasKolab::where('id_user',$dosen_id)
                         ->where('id_kelas',$kelas_id)
                         ->count();
        if($cek > 0) return redirect('dosen/kelas')->with(['msg' => 'Undangan telah dikirimkan sebelumnya', 'color' => 'danger']);

        $akses = $req->akses;

        $uraian = ($akses == 1)
            ? 'Memposting, menyunting, dan menghapus materi, serta memberikan tugas, me-review dan menilai tugas mahasiswa'
            : 'Me-review tugas mahasiswa untuk dilaporkan kepada dosen pengampu';

        $kolab = new KelasKolab();
        $kolab->id_user = $dosen_id;
        $kolab->id_kelas = $kelas_id;
        $kolab->status = '0';
        $kolab->akses = $akses;
        $kolab->save();

        $url = 'invitation/accepted/'.$kolab->id;


        $to = User::find($dosen_id);
        $to_name = $to->fullname;
        $to_email = $to->email;

        $data = [
            'receiver' => $to->fullname,
            'senderName' => Auth::user()->fullname,
            'senderUniv' => Auth::user()->dosen->univ,
            'kelasName' => Kelas::find($kelas_id)->kelas_nama,
            'link' => url($url),
            'akses' => $uraian
        ];

        Mail::send('emails.template2', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Undangan Kontribusi Kelas');
            $message->from('rektor.sipeka@gmail.com','Rektor SiPeka');
        });

        return redirect('dosen/kelas')->with(['msg' => 'Undangan Berhasil Dikirimkan', 'color' => 'success']);
    }
}
