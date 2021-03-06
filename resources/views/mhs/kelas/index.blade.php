@extends('layouts.utama')

@section('title')
    Mahasiswa &middot; Kelas
@endsection

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card text-white kelasheader">
      <div class="card-body">
        <h3 class="card-title" style="font-weight:700;">Daftar Kelas yang Diikuti</h3>
        <p class="card-text">Di bawah ini kelas-kelas yang sedang anda ikut. Ingin gabung kelas lain?</p>
        <a href="{{url('daftar-kelas')}}" class="btn btn-join">Gabung Sekarang</a>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin-top:30px;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <!-- search form -->
                <div class="row">
                    <div class="col-md-6">
                        <form class="">
                            <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari kelas yang pernah diikuti ..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                Cari Kelas
                                </button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end search -->

                <div class="row" style="margin-top:20px;">
                    <!-- <div class="col-md-4">
                        <div class="card itemkelas">
                            <div class="card-body">
                                <p class="kelas-detailkategori">Web Programming</p>
                                <h5 class="card-title">Website Apotik dengan CodeIgniter</h5>
                                <p class="card-text"><i class="fa fa-clipboard"></i> 30 Materi &nbsp;&nbsp;<i class="fa fa-chart-bar"></i> 50% | <span class="statusbelumtuntas">Belum Tuntas</span></p>
                                <br><a href="#" class="btn" style="margin-left:10px;">Lihat Kelas</a>
                            </div>
                        </div>
                    </div> -->
                    @foreach($kls as $k)
                    <div class="col-md-4">
                        <div class="card itemkelas">
                            <div class="card-body">
                                <p class="kelas-detailkategori">{{$k->detail_kategori->dkat_nama}}</p>
                                <h5 class="card-title">{{$k->kelas_nama}}</h5>
                                <p class="card-text">
                                    <i class="fa fa-clipboard"></i> {{$k->materi()->count()}} Materi &nbsp;&nbsp;
                                    {{-- <i class="fa fa-chart-bar"></i> {{$k->pivot->progress}}% |  --}}
                                    @if($k->status_kelas == 2)<span class="statustuntas">Tuntas</span>@else<span class="statusbelumtuntas">Belum Tuntas </span>@endif</p>
                                <br><a href="{{route('lihat-kelas',$k->kelas_kode)}}" class="btn btn-primary" style="margin-left:10px;">Lihat Kelas</a>@if($k->status_kelas == 2)<a href="{{route('cetakSertifikat',$k->id)}}" class="btn btn-success"><i class="fa fa-download"></i> Sertifikat</a>@endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
