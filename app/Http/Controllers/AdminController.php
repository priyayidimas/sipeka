<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function kategori()
    {
        $kategori = \App\Model\Kategori::all();
        return view('admin.kategori', compact('kategori'));
    }

}
