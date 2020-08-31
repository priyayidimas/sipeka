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
                  <h3 class="kartu-title">{{$cKelas}}
                    <small>Kelas</small>
                  </h3>
                </div>
                <div class="kartu-footer">
                  <div class="stats">
                    <a href="{{url('mhs/kelas')}}">Lihat Detail</a>
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
                  <h3 class="kartu-title">{{$cSelesai}}
                    <small>Kelas</small>
                  </h3>
                </div>
                <div class="kartu-footer">
                  <div class="stats">
                    <a href="{{url('mhs/kelas')}}">Lihat Detail</a>
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
                  <h3 class="kartu-title">{{$cProgress}}
                    <small>Kelas</small>
                  </h3>
                </div>
                <div class="kartu-footer">
                  <div class="stats">
                    <a href="{{url('mhs/kelas')}}">Lihat Detail</a>
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
                <div class="kartu-header kartu-header-info">
                  <h4 class="kartu-title">Upcoming Meeting</h4>
                  <p class="kartu-category">Acara Ditampilkan 30 Menit Sebelum Dimulai</p>
                </div>
                <div class="kartu-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-info">
                      <th>Nama Acara</th>
                      <th>Nama Kelas</th>
                      <th>Tanggal</th>
                      <th>Waktu</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                    @foreach ($kelas as $kls)
                    @php
                    $mulai = Carbon::now()->setTimezone('Asia/Jakarta')->addMinutes(-30);
                    $akhir = Carbon::now()->setTimezone('Asia/Jakarta')->addHour()->addMinutes(30);

                    $events = $kls->event()->whereBetween('waktu_mulai',[$mulai, $akhir])->get();
                    @endphp
                    @foreach ($events as $event)
                    <tr>
                      <td>{{$event->title}}</td>
                      <td>{{$event->kelas->kelas_nama}}</td>
                      <td>{{Carbon::parse($event->waktu_mulai)->format('d F Y @ H:i')}}</td>
                      <td>{{Carbon::parse($event->waktu_selesai)->format('d F Y @ H:i')}}</td>
                      <td><a href="{{url('mhs/event/'.$event->id.'/join/'.$kls->pivot->id)}}" class="btn btn-dark">Go Meet</a></td>
                    </tr>
                    @endforeach
                    @endforeach
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
                      <th>Kategori</th>
                      <th>Detail Peminatan</th>
                    </thead>
                    <tbody>
                      <tr>
                          <td>{{$bio->minat_1->kategori->kat_nama}}</td>
                          <td>{{$bio->minat_1->dkat_nama}}</td>
                      </tr>
                      <tr>
                          <td>{{$bio->minat_2->kategori->kat_nama}}</td>
                          <td>{{$bio->minat_2->dkat_nama}}</td>
                      </tr>
                      <tr>
                          <td>{{$bio->minat_3->kategori->kat_nama}}</td>
                          <td>{{$bio->minat_3->dkat_nama}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
@endsection
