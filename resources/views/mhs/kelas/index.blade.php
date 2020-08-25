@extends('layouts.utama')

@section('content')
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
                    <div class="col-md-6">
                        <form class="">
                            <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Masukkan Kode Kelas..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                Gabung Kelas
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
                    <div class="col-md-4">
                        <div class="card itemkelas">
                            <div class="card-body">
                                <p class="kelas-detailkategori">Web Programming</p>
                                <h5 class="card-title">Website Apotik dengan CodeIgniter</h5>
                                <p class="card-text"><i class="fa fa-clipboard"></i> 30 Materi &nbsp;&nbsp;<i class="fa fa-chart-bar"></i> 50% | <span class="statusbelumtuntas">Belum Tuntas</span></p>
                                <br><a href="#" class="btn" style="margin-left:10px;">Lihat Kelas</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card itemkelas">
                            <div class="card-body">
                                <p class="kelas-detailkategori">Web Programming</p>
                                <h5 class="card-title">Website Apotik dengan CodeIgniter</h5>
                                <p class="card-text"><i class="fa fa-clipboard"></i> 30 Materi &nbsp;&nbsp;<i class="fa fa-chart-bar"></i> 100% | <span class="statustuntas">Tuntas</span></p>
                                <br><a href="#" class="btn" style="margin-left:10px;">Lihat Kelas</a><a href="#" class="btn"><i class="fa fa-download"></i> Sertifikat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection