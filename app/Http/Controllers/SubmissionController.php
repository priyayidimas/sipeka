<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Jawaban;
use App\Model\Kelas;
use App\User;
use Auth;

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
}
