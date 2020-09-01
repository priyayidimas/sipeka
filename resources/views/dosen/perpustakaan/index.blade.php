@extends('layouts.utama')

@section('title')
    Dosen &middot; Perpustakaan
@endsection

@section('heading')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i aria-hidden="true" class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a></i> Kelas</a></li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="row" style="margin-top:30px;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <!-- search form -->
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmodul">
                            Tambah Modul
                        </button>
                        <br><br>
                    </div>
                    <div class="col-md-6">
                        <form class="">
                            <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Cari kelas yang pernah diikuti ..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                Cari Modul
                                </button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end search -->

                <div class="row" style="margin-top:20px;">
                    @foreach($lb as $k)
                    <div class="col-md-4">
                        <div class="card itemkelas">
                            <div class="card-body">
                                <p class="kelas-detailkategori">{{$k->detail_kategori->dkat_nama}}</p>
                                <h5 class="card-title">{{$k->judul}}</h5>
                                <a href="{{route('editkelas',$k->id)}}" class="btn btn-success" style="margin-left:5px;">Update</a>
                                <button type="button" style="margin-left:5px;float:right;" class="btn btn-danger" data-toggle="modal" data-target="#deleteKelas" data-idkelas="{{$k->id}}">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahmodul" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Modul</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="{{route('storemod')}}" method="post" class="form-group" id="t-modul" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Judul Modul</label>
                    <input type="text" name="judul" class="form-control" placeholder="Judul Modul" id="" required>
                </div>
                <div class="form-group">
                    <label for="">File Modul</label>
                    <input type="file" name="namafile" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="kategori_id" class="form-control" id="" required>
                        <option value="" disabled>Pilih Kategori</option>
                        @foreach($dk as $k)
                        <option value="{{$k->id}}">{{$k->dkat_nama}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('t-modul').submit();" class="btn btn-primary">Submit</button>
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
