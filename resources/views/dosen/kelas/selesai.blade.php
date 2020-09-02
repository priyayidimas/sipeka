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

        $('#deleteEvent').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var idEvent = button.data('id');

            var modal = $(this);
            modal.find('.modal-body #idEvent').val(idEvent);
        });

    });
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-11 menu-kelola-content">

    </div>
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
