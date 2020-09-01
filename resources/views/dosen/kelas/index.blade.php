@extends('layouts.utama')
@section('heading')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i aria-hidden="true" class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a></i> Kelas</a></li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card text-white kelasheader">
      <div class="card-body">
        <h3 class="card-title" style="font-weight:700;">Daftar kelas yang dibuat</h3>
        <p class="card-text">Di bawah ini kelas-kelas yang sedang anda ikut. Lihat kelas lain?</p>
        <a href="{{url('mhs/kelas/daftar-kelas')}}" class="btn btn-join">Lihat Daftar Kelas</a>
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
                        <a href="{{url('dosen/kelas/tambah')}}" class="btn btn-tambahkelas">Tambah Kelas</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{url('daftar-dosen')}}" class="btn btn-primary">Undang Kolaborator</a><br><br>
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

                <br><h5>Kelas Yang Anda Ampu</h5>
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
                                    <i class="fa fa-users"></i> {{$k->join()->count()}}
                                </p>
                                <br>
                                <a href="{{route('editkelas',$k->id)}}" class="btn btn-success" style="margin-left:5px;">Kelola</a>
                                <button type="button" style="margin-left:5px;float:right;" class="btn btn-danger" data-toggle="modal" data-target="#deleteKelas" data-idkelas="{{$k->id}}">
                                    Delete
                                </button>
                                <a href="{{route('listsubmis',$k->id)}}" class="btn btn-primary" style="margin-left:5px;">Submission</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if (Auth::user()->kolab()->count() > 0)

                <br><h5>Anda Mendampingi Kelas</h5>
                <div class="row" style="margin-top:20px;">
                    @foreach(Auth::user()->kolab as $k)
                    <div class="col-md-4">
                        <div class="card itemkelas">
                            <div class="card-body">
                                <p class="kelas-detailkategori">{{$k->detail_kategori->dkat_nama}}</p>
                                <h5 class="card-title">{{$k->kelas_nama}}</h5>
                                <p class="card-text">
                                    <i class="fa fa-clipboard"></i> @php $jmlMateri=0 @endphp @foreach($k->materi as $m) @php $jmlMateri += 1 @endphp @endforeach {{$jmlMateri}} Materi &nbsp;&nbsp;
                                    <i class="fa fa-info-circle"></i> <span class="@if($k->status_kelas == 0)statusbelumtuntas @else statustuntas @endif">@if($k->status_kelas == 0) Tidak Aktif @else Aktif @endif</span>&nbsp;&nbsp;
                                    <i class="fa fa-users"></i> {{$k->join()->count()}}
                                </p>
                                <br>
                                <a href="{{route('editkelas',$k->id)}}" class="btn btn-success" style="margin-left:5px;">Kelola</a>
                                <button type="button" style="margin-left:5px;float:right;" class="btn btn-danger" data-toggle="modal" data-target="#deleteKelas" data-idkelas="{{$k->id}}">
                                    Delete
                                </button>
                                <a href="{{route('listsubmis',$k->id)}}" class="btn btn-primary" style="margin-left:5px;">Submission</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Materi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h4 class="text-center">Anda yakin ingin menghapus kelas ini?</h4>
            <form action="{{route('hapuskelas')}}" method="post" class="form-group" id="d-kelas" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idkelas" id="idm">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('d-kelas').submit();" class="btn btn-danger">Hapus</button>
        </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    $('#deleteKelas').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var idkelas = button.data('idkelas');

        var modal = $(this);
        modal.find('.modal-body #idm').val(idkelas);
    });
</script>
@endsection
