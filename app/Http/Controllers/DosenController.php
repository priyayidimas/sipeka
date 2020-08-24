<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class DosenController extends Controller
{

    public function index()
    {
        return view('dosen.home');
    }
}
