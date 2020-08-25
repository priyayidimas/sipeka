<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Kategori;
use App\Model\DetailKategori;

class KategoriController extends Controller
{
    public function insertKategori(Request $req){
        $kategori = new Kategori;
        $kategori->fill($req->all());
        $kategori->save();
    }
    public function insertDetailKategori(Request $req){
        $dkategori = new DetailKategori;
        $dkategori->fill($req->all());
        $dkategori->save();
    }

    public function updateKategori(Request $req){
        $kategori = new Kategori;
        $kategori->fill($req->all());
        $kategori->save();
    }
    public function updateDetailKategori(Request $req){
        $dkategori = new DetailKategori;
        $dkategori->fill($req->all());
        $dkategori->save();
    }
}
