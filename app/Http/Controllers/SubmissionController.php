<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Jawaban;
use App\Model\Kelas;
use App\User;
use App\Model\Materi;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function reviewJawaban(Request $req)
    {
        $jawaban = Jawaban::find($req->jawaban_id);
        $jawaban->fill($req->all());
        $jawaban->reviewer_id = Auth::id();
        $jawaban->save();

        return redirect(route('periksa',$req->jawaban_id))->with(['color' => 'success', 'msg' => 'Berhasil Review Jawaban']);
    }

    public function periksa($id)
    {
        $jawaban = Jawaban::find($id);
        return view('dosen.kelas.periksa',compact('jawaban'));
    }

    public function akhiriKelas($id)
    {
        $kls = Kelas::find($id);
        return view('dosen.kelas.selesai',compact('kls'));
    }

    public function gradeKelas(Request $req)
    {
        if(array_sum($req['bobot']) != 1.0) return back()->with(['color' => 'danger', 'msg' => 'Jumlah Seluruh Bobot Harus 1']);

        $kelas = Kelas::find($req->idKelas);
        foreach ($kelas->join as $mhs) {
            $nilai = 0;
            foreach ($req['bobot'] as $materiId => $bobot) {
                $jawaban = Jawaban::where('id_materi',$materiId)
                                  ->where('id_mhs',$mhs->id)->first();
                if($jawaban){
                    $tempNilai = ($jawaban->grade != null) ? ($jawaban->grade * $bobot) : 0;
                    $nilai += $tempNilai;
                }else{
                    $nilai += 0;
                }
            }
            $kelas->join()->updateExistingPivot($mhs->id,['grade' => $nilai]);
        }
        $kelas->status_kelas = '2';
        $kelas->save();
        return redirect()->route('editkelas',$kelas->id)->with(['msg' => 'Berhasil mengakhiri kelas!', 'color' => 'success']);
    }
}
