@extends('layouts.utama')

@section('title')
Dosen &middot; Kelola Kelas
@endsection

@section('heading')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i aria-hidden="true" class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="/dosen/kelas"></i> Kelas</a></li>
            <li class="breadcrumb-item"><a></i> Kelola Kelas - {{$kls->kelas_nama}}</a></li>
        </ol>
    </nav>
@endsection

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
            var judulmodul = button.data('judulmodul');

            var modal = $(this);
            modal.find('.modal-body #judul').val(judul);
            modal.find('.modal-body #desc').val(desc);
            modal.find('.modal-body #idytb').val(idytb);
            modal.find('.modal-body #idmateri').val(idmateri);
            modal.find('.modal-body #judulmodul').val(judulmodul);
            if (jenis == '0') {document.getElementById("mt").selected = true;}else if(jenis == '1'){document.getElementById("pt").selected = true;}else if(jenis == '2'){document.getElementById("mpt").selected = true;}
            if (statusfile == '0') {document.getElementById("pb").selected = true;}else if(statusfile == '1'){document.getElementById("pr").selected = true;}
        });
        $('#deleteMateri').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var idmateri = button.data('idmateri');

            var modal = $(this);
            modal.find('.modal-body #idm').val(idmateri);
        });

        $('.datetimepicker').datetimepicker({
            format: 'DD MMMM YYYY @ HH:mm',
            minDate: moment()
        });

        $('.js-example-basic-single').select2();

        $('.jenisMateriCreate').change(function () {
            const selected = $('.jenisMateriCreate').val();
            console.log(selected);
            if(selected == '1'){
                $('.judulModul').hide();
                $('.statusModul').hide();
                $('.linkYoutube').hide();
            }else{
                $('.judulModul').show();
                $('.statusModul').show();
                $('.linkYoutube').show();
            }
        });

        $('.jenisMateriUpdate').change(function () {
            const selected = $('.jenisMateriUpdate').val();
            console.log(selected);
            if(selected == '1'){
                $('.judulModul').hide();
                $('.statusModul').hide();
                $('.linkYoutube').hide();
            }else{
                $('.judulModul').show();
                $('.statusModul').show();
                $('.linkYoutube').show();
            }
        });

        $('#updateEvent').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var desc = button.data('desc');
            var mulai = button.data('mulai');
            var selesai = button.data('selesai');
            var id = button.data('id');

            var modal = $(this);
            modal.find('.modal-body #title').val(title);
            modal.find('.modal-body #desc').val(desc);
            modal.find('.modal-body #mulai').val(mulai);
            modal.find('.modal-body #selesai').val(selesai);
            modal.find('.modal-body #id').val(id);
        });

        $('#deleteEvent').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var idEvent = button.data('id');

            var modal = $(this);
            modal.find('.modal-body #idEvent').val(idEvent);
        });

        $('#inviteKolabModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            var modal = $(this);
            modal.find('.modal-body #kolabId').val(id);
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
            {{-- Info Kelas --}}
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
                        <label for="">Status Kelas : </label>
                        @if ($kls->status_kelas < 2)
                        <select name="status_kelas" class="form-control" id="">
                            <option value="1"@if($kls->status_kelas == 1) selected @endif>Aktif</option>
                            <option value="0"@if($kls->status_kelas == 0) selected @endif>Tidak Aktif</option>
                        </select>
                        @else
                        <label for="">Selesai</label>
                        <input type="hidden" name="status_kelas" value="2">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Group Telegram</label>
                        <input type="text" name="link_tel" class="form-control" placeholder="Link Group Telegram ..." id="" value="{{$kls->link_tel}}">
                    </div>
                    <div class="form-group text-right">
                        <input type="submit" value="Submit" class="btn btn-primary">
                        @if ($kls->status_kelas < 2)
                        <a href="{{url('dosen/kelas/selesai/'.$kls->id)}}" class="btn btn-success">Akhiri Kelas</a>
                        @endif
                    </div>
                </form>
            </div>
            {{-- Materi --}}
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
                            <i class="fa fa-file-alt" style="color:grey"></i> @if($m->filemodul != NULL)<a href="{{url('storage/modul/'.$m->filemodul)}}">Download Modul</a> @else Tidak Tersedia @endif &nbsp;
                            <i class="fa fa-lock" style="color:grey;"></i> @if($m->statusfile == 0) Public @else Private @endif &nbsp;
                            <i class="fa fa-info-circle" style="color:grey;"></i> @if($m->jenis == 0) Materi @elseif($m->jenis==1) Pertanyaan @elseif($m->jenis==2) Materi dan Pertanyaan @else Private @endif
                        </div>
                        <p class="card-text">
                            {{$m->desc}}
                        </p>
                        <br>
                        <button type="button" style="margin-left:5px;float:right;" class="btn btn-warning" data-toggle="modal" data-target="#updateMateri" data-idmateri="{{$m->id}}" data-judul="{{$m->judul}}" data-jenis="{{$m->jenis}}" data-judulmodul="{{$m->judul_modul}}" data-statusfile="{{$m->statusfile}}" data-desc="{{$m->desc}}" data-idytb="{{$m->idytb}}">
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
            {{-- Event --}}
            <div class="tab-pane fade" id="event" role="tabpanel" aria-labelledby="event-tab">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createEvent">
                    Jadwalkan Pertemuan
                </button>
                @foreach($kls->event as $event)
                <div class="card itemmateri" style="margin-top:10px;">
                    <div class="card-body">
                        <h5 class="card-title">{{$event->title}}</h5>
                        <p class="card-text">
                            {{$event->desc}}
                        </p>
                        <div class="card-text">
                            <p>{{$mulai = Carbon::parse($event->waktu_mulai)->format('d F Y @ H:i')}}</p>
                            <p>{{$selesai = Carbon::parse($event->waktu_selesai)->format('d F Y @ H:i')}}</p>
                        </div>
                        <br>
                        <button type="button" style="margin-left:5px;float:right;" class="btn btn-warning" data-toggle="modal" data-target="#updateEvent" data-id="{{$event->id}}" data-title="{{$event->title}}" data-desc="{{$event->desc}}" data-mulai="{{$mulai}}" data-selesai="{{$selesai}}">
                            Edit
                        </button>
                        <button type="button" style="margin-left:5px;float:right;" class="btn btn-danger" data-toggle="modal" data-target="#deleteEvent" data-id="{{$event->id}}">
                            Delete
                        </button>
                    </div>
                </div>
                <br>
                @endforeach
            </div>
            {{-- Kolaborasi --}}
            <div class="tab-pane fade" id="kolaborasi" role="tabpanel" aria-labelledby="kolaborasi-tab">
                <h2>Kolaborasi</h2>
                <table class="table">
                    <thead>
                        <th colspan="2">Kolaborator</th>
                        <th>Akses</th>
                    </thead>
                    @forelse ($kls->kolab as $kolab)
                        <tr>
                            <td><img class="rounded" src="{!! $kolab->avatar !!}" alt="" width="50"></td>
                            <td>{{$kolab->fullname}}</td>
                            <td>{{($kolab->pivot->akses == 1) ? 'Dosen Pendamping' : 'Reviewer'}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Data Kosong</td>
                        </tr>
                    @endforelse
                </table>
            </div>
            {{-- Mahasiswa --}}
            <div class="tab-pane fade" id="mhs" role="tabpanel" aria-labelledby="mhs-tab">
                <table class="table">
                    <thead>
                        <th colspan="2">Mahasiswa</th>
                        <th>Progress</th>
                        <th>Nilai Akhir</th>
                        <th>Aksi</th>
                    </thead>
                    @foreach ($kls->join as $mhs)
                        <tr>
                            <td><img class="rounded" src="{!! $mhs->avatar !!}" alt="" width="50"></td>
                            <td>{{ $mhs->fullname }}</td>
                            <td>{{ $mhs->pivot->progress }}</td>
                            <td>{{ ($mhs->pivot->grade) ?? 'Belum Ada' }}</td>
                            <td>
                                <a class="btn btn-sm btn-success text-white" >Detail</a>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#inviteKolabModal" data-id={{$mhs->id}}>Undang</button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <!-- /.col-md-8 -->
</div>
<section id="modals-only">
    {{-- Add Materi --}}
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
                    <select name="jenis" class="form-control jenisMateriCreate" required>
                        <option value="" disabled>Pilih Jenis Materi</option>
                        <option value="0">Materi</option>
                        <option value="1">Pertanyaan</option>
                        <option value="2">Materi dan Pertanyaan</option>
                    </select>
                </div>
                <div class="form-group judulModul">
                    <label for="">Judul Modul</label>
                    <input name="judul_modul" placeholder="Judul Modul ..." type="text" class="form-control">
                </div>
                <div class="form-group fileModul">
                    <label for="">Modul Materi</label>
                    <input name="filemodul" type="file" class="form-control-file">
                </div>
                <div class="form-group linkYoutube">
                    <label for="">ID Video Youtube</label>
                    <input name="idytb" placeholder="Masukkan ID YouTube ..." type="text" class="form-control">
                    <i style="font-size:12px;">https://www.youtube.com/watch?v=<b style="color:blue;">idyoutube</b></i>
                </div>
                <div class="form-group statusModul">
                    <label for="">Status Modul</label>
                    <select name="statusfile" id="" class="form-control">
                        <option value="" disabled selected>Pilih Status Modul</option>
                        <option value="1">Private</option>
                        <option value="0">Public</option>
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
    {{-- Update Materi --}}
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
                    <select id="" name="jenis" class="form-control jenisMateriUpdate" required>
                        <option value="" disabled>Pilih Jenis Materi</option>
                        <option value="0" id="mt">Materi</option>
                        <option value="1" id="pt">Pertanyaan</option>
                        <option value="2" id="mpt">Materi dan Pertanyaan</option>
                    </select>
                </div>
                <div class="form-group judulModul">
                    <label for="">Judul Modul</label>
                    <input name="judul_modul" id="judulmodul" placeholder="Judul Modul ..." type="text" class="form-control">
                </div>
                <div class="form-group fileModul">
                    <label for="">Modul Materi</label>
                    <input name="filemodul" placeholder="Pertanyaan ..." type="file" class="form-control-file">
                </div>
                <div class="form-group linkYoutube">
                    <label for="">ID Video Youtube</label>
                    <input name="idytb" id="idytb" value="" placeholder="Masukkan ID YouTube ..." type="text" class="form-control">
                    <i style="font-size:12px;">https://www.youtube.com/watch?v=<b style="color:blue;">idyoutube</b></i>
                </div>
                <div class="form-group statusModul">
                    <label for="">Status Modul</label>
                    <select name="statusfile" class="form-control">
                        <option value="" disabled>Pilih Status Modul</option>
                        <option value="1" id="pr">Private</option>
                        <option value="0" id="pb">Public</option>
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
    {{-- Delete Materi --}}
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
    {{-- Buat Event --}}
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
                <input type="hidden" name="id_kelas" value="{{$kls->id}}">
                <div class="form-group">
                    <label for="">Nama Kelas</label>
                    <input type='text' class="form-control" name="" value="{{$kls->kelas_nama}}" disabled/>
                </div>
                <div class="form-group">
                    <label for="">Nama Acara</label>
                    <input type='text' class="form-control" name="title" placeholder="Masukkan Nama Acara"/>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi Acara</label>
                    <input type='text' class="form-control" name="desc" placeholder="Masukkan Deskripsi Acara"/>
                </div>
                <div class="form-group">
                    <label for="">Tanggal dan Waktu Acara -> Mulai</label>
                    <input type='text' class="form-control datetimepicker" id='' name="waktu_mulai" placeholder="Tanggal dan Waktu Mulai Acara" />
                </div>
                <div class="form-group">
                    <label for="">Tanggal dan Waktu Acara -> Selesai</label>
                    <input type='text' class="form-control datetimepicker" id='' name="waktu_selesai" placeholder="Tanggal dan Waktu Selesai Acara" />
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
    {{-- Ubah Event --}}
    <div class="modal fade" id="updateEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Jadwalkan Pertemuan Daring</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('dosen/events/patch')}}" class="form-group" id="updateEventForm">
                  @csrf
                  <input type="hidden" name="id" id='id'>
                    <input type="hidden" name="id_kelas" value="{{$kls->id}}">
                  <div class="form-group">
                      <label for="">Nama Kelas</label>
                      <input type='text' class="form-control" name="" value="{{$kls->kelas_nama}}" disabled/>
                  </div>
                  <div class="form-group">
                      <label for="">Nama Acara</label>
                      <input type='text' class="form-control" id='title' name="title" placeholder="Masukkan Nama Acara"/>
                  </div>
                  <div class="form-group">
                      <label for="">Deskripsi Acara</label>
                      <input type='text' class="form-control" id='desc' name="desc" placeholder="Masukkan Deskripsi Acara"/>
                  </div>
                  <div class="form-group">
                      <label for="">Tanggal dan Waktu Acara -> Mulai</label>
                      <input type='text' class="form-control datetimepicker" id='mulai' name="waktu_mulai" placeholder="Tanggal dan Waktu Mulai Acara" />
                  </div>
                  <div class="form-group">
                      <label for="">Tanggal dan Waktu Acara -> Selesai</label>
                      <input type='text' class="form-control datetimepicker" id='selesai' name="waktu_selesai" placeholder="Tanggal dan Waktu Selesai Acara" />
                  </div>
              </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" onclick="event.preventDefault(); document.getElementById('updateEventForm').submit();" class="btn btn-primary">Submit</button>
              </div>
          </div>
        </div>
    </div>
    {{-- Delete Event --}}
    <div class="modal fade" id="deleteEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Batalkan Pertemuan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <h4 class="text-center">Anda yakin ingin membatalkan pertemuan ini?</h4>
                <form action="{{route('delete-event')}}" method="post" class="form-group" id="delete-event">
                    @csrf
                    <input type="hidden" name="idEvent" id="idEvent">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" onclick="event.preventDefault(); document.getElementById('delete-event').submit();" class="btn btn-danger">Hapus</button>
            </div>
        </div>
      </div>
    </div>
    {{-- Invite Kolaborator --}}
    <div class="modal fade" id="inviteKolabModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Undang Kolaborator</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('dosen/invite')}}" class="form-group" id="inviteKolab">
                  @csrf
                  <input type="hidden" name="dosen_id" id="kolabId">
                  <div class="form-group">
                    <label for="">Undang Ke Kelas</label>
                    <select name="kelas_id" id="" class="form-control js-example-basic-single" required>
                        <option disabled value="">Pilih Kelas</option>
                        @foreach(Auth::user()->kelas as $kelas)
                        <option value="{{$kelas->id}}">{{$kelas->kelas_nama}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Untuk Menjadi</label>
                    <select name="akses" id="" class="form-control js-example-basic-single" required>
                        <option disabled value="">Pilih Akses</option>
                        <option value="0">Reviewer</option>
                    </select>
                  </div>
              </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" onclick="event.preventDefault(); document.getElementById('inviteKolab').submit();" class="btn btn-primary">Submit</button>
              </div>
          </div>
        </div>
    </div>
</section>
@endsection
