@extends('layouts.utama')

@section('heading')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a><i aria-hidden="true" class="fa fa-home"></i> Home</a></li>
        </ol>
    </nav>
@endsection

@section('content')
<!-- Content Row -->
<div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="kartu kartu-stats">
                <div class="kartu-header kartu-header-rose kelasdiikuti kartu-header-icon">
                  <div class="kartu-icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <h class="kartu-category">Kelas Diikuti</h>
                  <h3 class="kartu-title">20
                    <small>Kelas</small>
                  </h3>
                </div>
                <div class="kartu-footer">
                  <div class="stats">
                    <a href="javascript:;">Lihat Detail</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="kartu kartu-stats">
                <div class="kartu-header kartu-header-danger kartu-header-icon">
                  <div class="kartu-icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <p class="kartu-category">Kelas Selesai</p>
                  <h3 class="kartu-title">5
                    <small>Kelas</small>
                  </h3>
                </div>
                <div class="kartu-footer">
                  <div class="stats">
                    <a href="javascript:;">Lihat Detail</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="kartu kartu-stats">
                <div class="kartu-header kartu-header-warning kartu-header-icon">
                  <div class="kartu-icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <p class="kartu-category">Kelas Proses</p>
                  <h3 class="kartu-title">15
                    <small>Kelas</small>
                  </h3>
                </div>
                <div class="kartu-footer">
                  <div class="stats">
                    <a href="javascript:;">Lihat Detail</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-lg-12 col-md-12">
              <div class="kartu">
                <div class="kartu-header kartu-header-warning">
                  <h4 class="kartu-title">Acara</h4>
                  <p class="kartu-category">Acara-acara yang akan dilaksanakan oleh kelas</p>
                </div>
                <div class="kartu-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>No</th>
                      <th>Nama Acara</th>
                      <th>Nama Kelas</th>
                      <th>Tanggal</th>
                      <th>Waktu</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Alur Framework Code Igniter</td>
                        <td>CodeIgniter</td>
                        <td>4 Agustus 2020</td>
                        <td>14.00 WIB</td>
                        <td><a href="" class="btn btn-dark">Go Meet</a></td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Full Stack Developer</td>
                        <td>Web Learning</td>
                        <td>3 Agustus 2020</td>
                        <td>15.00 WIB</td>
                        <td><a href="" class="btn btn-dark">Go Meet</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>

          <div class="row">

            <!-- Area Chart -->
            <div class="col-lg-6 col-md-12">
              <div class="kartu">
                <div class="kartu-header kartu-header-warning">
                  <h4 class="kartu-title">Undangan Asisten</h4>
                  <p class="kartu-category">Undangan menjadi asisten kelas</p>
                </div>
                <div class="kartu-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>No</th>
                      <th>Nama Kelas</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Alur Framework Code Igniter</td>
                        <td><a href="" class="btn btn-success">Terima</a></td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Full Stack Developer</td>
                        <td><a href="" class="btn btn-info">Lihat Kelas</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-12">
              <div class="kartu">
                <div class="kartu-header kartu-header-primary">
                  <h4 class="kartu-title">Peminatan</h4>
                  <p class="kartu-category">Peminatan yang dipilih</p>
                </div>
                <div class="kartu-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>No</th>
                      <th>Kategori</th>
                      <th>Detail Peminatan</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Informatika</td>
                        <td>Web Programming</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Informatika</td>
                        <td>Mobile Programming</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Informatika</td>
                        <td>Rekayasa Perangkat Lunak</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
@endsection
