@php
    $kelas = $jawaban->materi->kelas;
    $akses = 1;
    if(Auth::id() != $kelas->dosen_id){
        $akses = Auth::user()->kolab()->where('id_kelas',$kelas->id)->first()->pivot->akses;
    }
    $isGrader = ($akses == 1) || (Auth::id() == $kelas->dosen_id);
@endphp
@extends('layouts.utama')

@section('title')
Mahasiswa &middot; Review Pekerjaan
@endsection

@section('heading')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i aria-hidden="true" class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="/mhs/kelas"></i> Kelas</a></li>
            <li class="breadcrumb-item"><a href="{{url('mhs/kelas/submission/'.$jawaban->materi->kelas->id)}}"></i> Lihat Detail Kelas</a></li>
            <li class="breadcrumb-item"><a href="{{url('mhs/kelas/list-submission/'.$jawaban->materi->id)}}"></i> Submission</a></li>
            <li class="breadcrumb-item"><a></i> Periksa jawaban</a></li>
        </ol>
    </nav>
@endsection
@section('content')
<div class="card">
    <div class="card-body card-periksa">
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <h5>{{$jawaban->mahasiswa->fullname}}</h5>
                <p class="nama-univ">{{$jawaban->mahasiswa->mahasiswa->univ}}</p>
            </div>
        </div>
    </div>
</div>
<div class="card" style="margin-top:10px;">
    <div class="card-body">
        <b style="color:black;">{{$jawaban->materi->judul}}</b><br>
        <b>Deskripsi atau Intruksi Materi : </b><br>
        <p class="text-justify">{{$jawaban->materi->desc}}}</p>
        <b>Jawaban file : </b> <a href="{{url('storage/jawaban/'.$jawaban->jawaban_file)}}" class="jawab-file"><i class="fa fa-download"></i> &nbsp;&nbsp;{{$jawaban->jawaban_file}}</a><br>
        <b>Jawaban text : </b><br>
        <p class="text-justify">{{$jawaban->jawaban_text}}</p>
        <b style="color:black;">Nilai : {{($jawaban->grade) ?? 'Belum Dinilai'}}</b><br><br>
        @if ($jawaban->review)
        <div class="card">
            <div class="card-body reviewer-periksa">
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-1">
                         <img src="{!! $jawaban->reviewer->avatar !!}" class="rounded" width="50" alt="">
                    </div>
                    <div class="col-md-11 text-justify">
                        <b style="color:black;">{{$jawaban->reviewer->fullname}}</b><br>
                        {{$jawaban->review}}
                    </div>
                </div>
            </div>
        </div>
        @endif
        <form action="{{url('mhs/kelas/review-jawaban')}}" method="POST" class="form-row" style="margin-top:10px;">
            @csrf
            <input type="hidden" name="jawaban_id" value="{{$jawaban->id}}">
            <div class="col-md-8">
                <textarea type="text" name="review" class="form-control" placeholder="Tulis review atau komentar ..." id=""></textarea>
            </div>
            @if ($isGrader)
            <div class="col-md-2">
                <input type="number" name="grade" min="0" max="100" class="form-control" placeholder="Nilai ..." id="">
            </div>
            @endif
            <div class="col-md-2">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
        <hr>
    </div>
</div>
@endsection
