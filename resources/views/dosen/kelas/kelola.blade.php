@extends('layouts.utama')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="/assets/js/jquery.multifield.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/assets/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function () {
        var test = 0;
        $('#updateMateri').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var judul = button.data('judul');
            var desc = button.data('desc');
            var idytb = button.data('idytb');
            var statusfile = button.data('statusfile');
            var jenis = button.data('jenis');
            var idmateri = button.data('idmateri');

            var modal = $(this);
            modal.find('.modal-body #judul').val(judul);
            modal.find('.modal-body #desc').val(desc);
            modal.find('.modal-body #idytb').val(idytb);
            modal.find('.modal-body #idmateri').val(idmateri);
            if (jenis == '0') {document.getElementById("mt").selected = true;}else if(jenis == '1'){document.getElementById("pt").selected = true;}else if(jenis == '2'){document.getElementById("mpt").selected = true;}
            if (statusfile == '0') {document.getElementById("pb").selected = true;}else if(statusfile == '1'){document.getElementById("pr").selected = true;}
        });
        $('#deleteMateri').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var idmateri = button.data('idmateri');

            var modal = $(this);
            modal.find('.modal-body #idm').val(idmateri);
        });

        $('#datetimepicker1').datetimepicker({
            format: 'DD MMMM YYYY @ HH:mm'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'DD MMMM YYYY @ HH:mm'
        });
        $('.js-example-basic-single').select2();

        $('#editPertemuan').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var namaacara = button.data('namaevent');
            var descacara = button.data('descevent');
            var waktu = button.data('waktuevent');
            var kelas = button.data('kelas');
            var idevent = button.data('kdevent');

            var modal = $(this);
            modal.find('.modal-body #namaevent').val(namaacara);
            modal.find('.modal-body #descevent').val(descacara);
            modal.find('.modal-body .waktuevent').val(waktu);
            modal.find('.modal-body #kelas').val(kelas);
            modal.find('.modal-body #kdevent').val(idevent);
        });
    });
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3 mb-3 menu-kelola">
        <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Informasi Kelas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Materi Kelas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="event-tab" data-toggle="tab" href="#event" role="tab" aria-controls="event" aria-selected="false">Pertemuan Daring</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="kolaborasi-tab" data-toggle="tab" href="#kolaborasi" role="tab" aria-controls="kolaborasi" aria-selected="false">Kolaborasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mhs-tab" data-toggle="tab" href="#mhs" role="tab" aria-controls="mhs" aria-selected="false">Mahasiswa</a>
            </li>
        </ul>
    </div>
    <!-- /.col-md-4 -->
    <div class="col-md-8 menu-kelola-content">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form action="{{route('updatekelas',$kls->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <label for="">Nama Kelas</label>
                        <input type="text" name="kelas_nama" value="{{$kls->kelas_nama}}" class="form-control" placeholder="Nama Kelas" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi Kelas</label>
                        <textarea name="desc" class="form-control" rows="3" required>{{$kls->desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori Kelas</label>
                        <select name="dkat_id" id="" class="form-control js-example-basic-single" required>
                            <option disabled value="">Pilih Kategori Kelas</option>
                            @foreach($dkategori as $q)
                            <option value="{{$q->id}}"@if($q->id == $kls->dkat_id) selected @endif>{{$q->dkat_nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Status Kelas</label>
                        <select name="status_kelas" class="form-control" id="">
                            <option value="1"@if($kls->status_kelas == 1) selected @endif>Aktif</option>
                            <option value="0"@if($kls->status_kelas == 0) selected @endif>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Group Telegram</label>
                        <input type="text" name="link_tel" class="form-control" placeholder="Link Group Telegram ..." id="" value="{{$kls->link_tel}}">
                    </div>
                    <div class="form-group text-right">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                    Tambah Materi
                </button>
                @foreach($kls->materi as $m)
                <div class="card itemmateri" style="margin-top:10px;">
                    <div class="card-body">
                        <h5 class="card-title">{{$m->judul}}</h5>
                            <div class="card-text">
                            <i class="fab fa-youtube" style="color:red;"></i> @if($m->idytb != NULL)<a href="https://www.youtube.com/watch?v={{$m->idytb}}">Lihat Video</a> @else Tidak Tersedia @endif &nbsp;
                            <i class="fa fa-file-alt" style="color:grey"></i> @if($m->filemodul != NULL)<a href="/">Download Modul</a> @else Tidak Tersedia @endif &nbsp;
                            <i class="fa fa-lock" style="color:grey;"></i> @if($m->statusfile == 0) Public @else Private @endif &nbsp;
                            <i class="fa fa-info-circle" style="color:grey;"></i> @if($m->jenis == 0) Materi @elseif($m->jenis==1) Pertanyaan @elseif($m->jenis==2) Materi dan Pertanyaan @else Private @endif
                        </div>
                        <p class="card-text">
                            {{$m->desc}}
                        </p>
                        <br>
                        <button type="button" style="margin-left:5px;float:right;" class="btn btn-warning" data-toggle="modal" data-target="#updateMateri" data-idmateri="{{$m->id}}" data-judul="{{$m->judul}}" data-jenis="{{$m->jenis}}" data-statusfile="{{$m->statusfile}}" data-desc="{{$m->desc}}" data-idytb="{{$m->idytb}}">
                            Edit
                        </button>
                        <button type="button" style="margin-left:5px;float:right;" class="btn btn-danger" data-toggle="modal" data-target="#deleteMateri" data-idmateri="{{$m->id}}">
                            Delete
                        </button>
                    </div>
                </div>
                <br>
                @endforeach
            </div>
            <div class="tab-pane fade" id="event" role="tabpanel" aria-labelledby="event-tab">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createEvent">
                    Jadwalkan Pertemuan
                </button>
                @foreach($kls->materi as $m)
                <div class="card itemmateri" style="margin-top:10px;">
                    <div class="card-body">
                        <h5 class="card-title">{{$m->judul}}</h5>
                            <div class="card-text">
                            <i class="fab fa-youtube" style="color:red;"></i> @if($m->idytb != NULL)<a href="https://www.youtube.com/watch?v={{$m->idytb}}">Lihat Video</a> @else Tidak Tersedia @endif &nbsp;
                            <i class="fa fa-file-alt" style="color:grey"></i> @if($m->filemodul != NULL)<a href="/">Download Modul</a> @else Tidak Tersedia @endif &nbsp;
                            <i class="fa fa-lock" style="color:grey;"></i> @if($m->statusfile == 0) Public @else Private @endif &nbsp;
                            <i class="fa fa-info-circle" style="color:grey;"></i> @if($m->jenis == 0) Materi @elseif($m->jenis==1) Pertanyaan @elseif($m->jenis==2) Materi dan Pertanyaan @else Private @endif
                        </div>
                        <p class="card-text">
                            {{$m->desc}}
                        </p>
                        <br>
                        <button type="button" style="margin-left:5px;float:right;" class="btn btn-warning" data-toggle="modal" data-target="#updateMateri" data-idmateri="{{$m->id}}" data-judul="{{$m->judul}}" data-jenis="{{$m->jenis}}" data-statusfile="{{$m->statusfile}}" data-desc="{{$m->desc}}" data-idytb="{{$m->idytb}}">
                            Edit
                        </button>
                        <button type="button" style="margin-left:5px;float:right;" class="btn btn-danger" data-toggle="modal" data-target="#deleteMateri" data-idmateri="{{$m->id}}">
                            Delete
                        </button>
                    </div>
                </div>
                <br>
                @endforeach
            </div>
            <div class="tab-pane fade" id="kolaborasi" role="tabpanel" aria-labelledby="kolaborasi-tab">
                <h2>Kolaborasi</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, eveniet earum. Sed accusantium eligendi molestiae quo hic velit nobis et, tempora placeat ratione rem blanditiis voluptates vel ipsam? Facilis, earum!</p>
            </div>
            <div class="tab-pane fade" id="mhs" role="tabpanel" aria-labelledby="mhs-tab">
                <table class="table">
                    <tr>
                        <td colspan="2">Mahasiswa</td>
                        <td>Progress</td>
                        <td>Aksi</td>
                    </tr>
                    @foreach ($kls->join as $mhs)
                        <tr>
                            <td><img class="rounded" src="{!! $mhs->avatar !!}" alt="" width="50"></td>
                            <td>{{ $mhs->fullname }}</td>
                            <td>{{ $mhs->pivot->progress }}</td>
                            <td>Kick</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <!-- /.col-md-8 -->
  </div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Materi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{route('storemat',$kls->id)}}" method="post" enctype="multipart/form-data" class="form-group" id="tambahmateri">
              @csrf
            <div class="form-group">
                <label for="">Judul Materi</label>
                <input name="judul" placeholder="Judul Materi ..." type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Deskripsi Materi/Pertanyaan</label>
                <textarea name="desc" class="form-control" id="" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="">Jenis Materi</label>
                <select name="jenis" id="" class="form-control" required>
                    <option value="" disabled>Pilih Jenis Materi</option>
                    <option value="0">Materi</option>
                    <option value="1">Pertanyaan</option>
                    <option value="2">Materi dan Pertanyaan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Modul Materi</label>
                <input name="filemodul" placeholder="Pertanyaan ..." type="file" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="">ID Video Youtube</label>
                <input name="idytb" placeholder="Masukkan ID YouTube ..." type="text" class="form-control">
                <i style="font-size:12px;">https://www.youtube.com/watch?v=<b style="color:blue;">idyoutube</b></i>
            </div>
            <div class="form-group">
                <label for="">Status Modul</label>
                <select name="statusfile" id="" class="form-control" required>
                    <option value="" disabled>Pilih Status Modul</option>
                    <option value="0">Public</option>
                    <option value="1">Private</option>
                </select>
                <i style="font-size:12px;"><b>Public</b> akan tersedia di perpustakaan, <b>Private</b> hanya untuk materi di kelas</i>
            </div>
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('tambahmateri').submit();" class="btn btn-primary">Submit</button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="updateMateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Materi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{route('updatemat',$kls->id)}}" class="form-group" method="post" id="u-materi" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="_method" value="put">
          <input type="hidden" name="idmateri" id="idmateri">
            <div class="form-group">
                <label for="">Judul Materi</label>
                <input name="judul" id="judul" placeholder="Judul Materi ..." type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Deskripsi Materi/Pertanyaan</label>
                <textarea name="desc" id="desc" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="">Jenis Materi</label>
                <select name="jenis" class="form-control" required>
                    <option value="" disabled>Pilih Jenis Materi</option>
                    <option value="0" id="mt">Materi</option>
                    <option value="1" id="pt">Pertanyaan</option>
                    <option value="2" id="mpt">Materi dan Pertanyaan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Modul Materi</label>
                <input name="filemodul" placeholder="Pertanyaan ..." type="file" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="">ID Video Youtube</label>
                <input name="idytb" id="idytb" value="" placeholder="Masukkan ID YouTube ..." type="text" class="form-control">
                <i style="font-size:12px;">https://www.youtube.com/watch?v=<b style="color:blue;">idyoutube</b></i>
            </div>
            <div class="form-group">
                <label for="">Status Modul</label>
                <select name="statusfile" class="form-control" required>
                    <option value="" disabled>Pilih Status Modul</option>
                    <option value="0" id="pb">Public</option>
                    <option value="1" id="pr">Private</option>
                </select>
                <i style="font-size:12px;"><b>Public</b> akan tersedia di perpustakaan, <b>Private</b> hanya untuk materi di kelas</i>
            </div>
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('u-materi').submit();" class="btn btn-primary">Submit</button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteMateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Materi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h4 class="text-center">Anda yakin ingin menghapus materi ini?</h4>
            <form action="{{route('deletemat',$kls->id)}}" method="post" class="form-group" id="d-materi" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idmateri" id="idm">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('d-materi').submit();" class="btn btn-danger">Hapus</button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="createEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Jadwalkan Pertemuan Daring</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="POST" action="{{url('dosen/events/store')}}" class="form-group" id="tambahevent">
            @csrf
            {{-- <input type="hidden" name="id_kelas" value="1"> --}}
            <div class="form-group">
                <label for="">Nama Acara</label>
                <input type='text' class="form-control" name="title" placeholder="Masukkan Nama Acara"/>
            </div>
            <div class="form-group">
                <label for="">Deskripsi Acara</label>
                <input type='text' class="form-control" name="desc" placeholder="Masukkan Deskripsi Acara"/>
            </div>
            <div class="form-group">
                <label for="">Kelas</label>
                <select name="id_kelas" class="form-control js-example-basic-single">
                    <option value="1">Nama Kelas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Tanggal dan Waktu Acara -> Mulai</label>
                <input type='text' class="form-control" id='datetimepicker1' name="waktu_mulai" placeholder="Tanggal dan Waktu Mulai Acara" />
            </div>
            <div class="form-group">
                <label for="">Tanggal dan Waktu Acara -> Selesai</label>
                <input type='text' class="form-control" id='datetimepicker2' name="waktu_selesai" placeholder="Tanggal dan Waktu Selesai Acara" />
            </div>
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('tambahevent').submit();" class="btn btn-primary">Submit</button>
        </div>
    </div>
  </div>
</div>
@endsection
