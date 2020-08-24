<?php

namespace App\Http\Controllers;

use App\Model\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
