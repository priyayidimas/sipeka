@extends('layouts.utama')

@section('css')
<link rel="stylesheet" href="/assets/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/assets/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
            $(function () {
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
                  <p class="kartu-category">Kelas Dibuat</p>
                  <h3 class="kartu-title">{{$cKelas}}
                    <small>Kelas</small>
                  </h3>
                </div>
                <div class="kartu-footer">
                  <div class="stats">
                    <a href="{{url('dosen/kelas')}}">Lihat Detail</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="kartu kartu-stats">
                <div class="kartu-header kartu-header-danger kartu-header-icon">
                  <div class="kartu-icon">
                    <i class="fas fa-file"></i>
                  </div>
                  <p class="kartu-category">Modul Publik</p>
                  <h3 class="kartu-title">{{$cPublik}}
                    <small>Modul</small>
                  </h3>
                </div>
                <div class="kartu-footer">
                  <div class="stats">
                    <a href="{{url('dosen/kelas')}}">Lihat Detail</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="kartu kartu-stats">
                <div class="kartu-header kartu-header-warning kartu-header-icon">
                  <div class="kartu-icon">
                    <i class="fas fa-file-archive"></i>
                  </div>
                  <p class="kartu-category">Modul Private</p>
                  <h3 class="kartu-title">{{$cPrivate}}
                    <small>Modul</small>
                  </h3>
                </div>
                <div class="kartu-footer">
                  <div class="stats">
                    <a href="{{url('dosen/kelas')}}">Lihat Detail</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->



          <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="kartu">
                  <div class="kartu-header kartu-header-info">
                    <h4 class="kartu-title">Acara</h4>
                    <p class="kartu-category">Acara-acara yang akan dilaksanakan oleh kelas</p>
                  </div>
                  <div class="kartu-body table-responsive">
                    <table class="table table-hover">
                      <thead class="text-info">
                        <th>Nama Acara</th>
                        <th>Nama Kelas</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        @foreach ($events as $event)
                        <tr>
                          <td>{{$event->title}}</td>
                          <td>{{$event->kelas->kelas_nama}}</td>
                          <td>{{Carbon::parse($event->waktu_mulai)->format('d F Y @ H:i')}}</td>
                          <td>{{Carbon::parse($event->waktu_selesai)->format('d F Y @ H:i')}}</td>
                          <td><a href="{!! $event->link !!}" class="btn btn-dark">Go Meet</a></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

          </div>

          <div class="row">

            <!-- Area Chart -->
            <div class="col-lg-12 col-md-12">
              <div class="kartu">
                <div class="kartu-header kartu-header-warning">
                  <h4 class="kartu-title">Undangan Kolaborasi</h4>
                  <p class="kartu-category">Status undangan yang anda kirimkan</p>
                </div>
                <div class="kartu-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Nama</th>
                      <th>Nama Kelas</th>
                      <th>Akses</th>
                      <th>Status</th>
                    </thead>
                    <tbody>
                    @foreach ($kelas as $kls)
                    @foreach ($kls->kolab()->where('status','0')->get() as $invitation)
                    <tr>
                        <td>{{$invitation->fullname}}</td>
                        <td>{{$kls->kelas_nama}}</td>
                        <td>{{($invitation->pivot->akses == 1)
                               ? "Kolaborator" : "Reviewer"}}</td>
                        <td>Menunggu Persetujuan</td>
                    </tr>
                    @endforeach
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

<!-- tambah event -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Jadwalkan Pertemuan Daring</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="POST" action="{{route('storeEvent')}}" class="form-group" id="tambahevent">
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

<!-- update event -->
<div class="modal fade" id="editPertemuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Pertemuan Daring</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="" class="form-group" id="editevent">
              <input type="hidden" name="event_id" id="kdevent">
            <div class="form-group">
                <label for="">Nama Acara</label>
                <input type='text' class="form-control" id="namaevent" name="namacara" placeholder="Masukkan Nama Acara"/>
            </div>
            <div class="form-group">
                <label for="">Deskripsi Acara</label>
                <input type='text' class="form-control" id="descevent" name="desacara" placeholder="Masukkan Deskripsi Acara"/>
            </div>
            <div class="form-group">
                <label for="">Kelas</label>
                <select name="" id="kelas" class="form-control js-example-basic-single">
                    <option value="">Nama Kelas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Tanggal dan Waktu Acara</label>
                <input type="text" class="form-control waktuevent" id='datetimepicker1' name="waktu" placeholder="Tanggal dan Waktu Acara" />
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" onclick="event.preventDefault(); document.getElementById('editevent').submit();" class="btn btn-primary">Submit</button>
        </div>
    </div>
  </div>
</div>
<!-- delete event -->

@endsection
