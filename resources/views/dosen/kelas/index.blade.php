@extends('layouts.utama')

@section('content')
@if(Session::get('msg'))
    <div class="alert alert-{!! Session::get('color') !!} alert-dismissible fade show" role="alert">
    {!! Session::get('msg') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif
<div class="row">
  <div class="col-sm-12">
    <div class="card text-white kelasheader">
      <div class="card-body">
        <h3 class="card-title" style="font-weight:700;">Daftar Kelas yang Diikuti</h3>
        <p class="card-text">Di bawah ini kelas-kelas yang sedang anda ikut. Ingin gabung kelas lain?</p>
        <a href="#" class="btn btn-join">Gabung Sekarang</a>
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
                    <div class="col-md-12">
                        <a href="" class="btn btn-tambahkelas">Tambah Kelas</a><br><br>
                    </div>
                    <div class="col-md-6">
                        <form class="">
                            <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Masukkan Kode Kelas untuk Kolaborasi..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                Kolaborasi Kelas
                                </button>
                            </div>
                            </div>
                        </form>
                    </div>
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
                    @foreach($kelas as $k)
                    <div class="col-md-4">
                        <div class="card itemkelas">
                            <div class="card-body">
                                <p class="kelas-detailkategori">{{$k->detail_kategori->dkat_nama}}</p>
                                <h5 class="card-title">{{$k->kelas_nama}}</h5>
                                <p class="card-text">
                                    <i class="fa fa-clipboard"></i> @php $jmlMateri=0 @endphp @foreach($k->materi as $m) @php $jmlMateri += 1 @endphp @endforeach {{$jmlMateri}} Materi &nbsp;&nbsp;
                                    <i class="fa fa-info-circle"></i> <span class="@if($k->status_kelas == 0)statusbelumtuntas @else statustuntas @endif">@if($k->status_kelas == 0) Tidak Aktif @else Aktif @endif</span>&nbsp;&nbsp;
                                    <i class="fa fa-users"></i> 3.000
                                </p>
                                <br>
                                <a href="" class="btn btn-warning" style="margin-left:5px;">Kelola</a>
                                <a href="#" class="btn btn-danger" style="margin-left:5px;">Delete</a>
                                <a href="#" class="btn btn-primary" style="margin-left:5px;">Lihat Kelas</a>
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