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
                  format: 'DD MMMM YY @ HH:mm'
                });
                $('#datetimepicker2').datetimepicker({
                  format: 'DD MMMM YY @ HH:mm'
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
@if(Session::get('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    {!! Session::get('message') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@elseif(Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {!! Session::get('error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif
<!-- Content Row -->
<div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
              <div class="kartu kartu-stats">
                <div class="kartu-header kartu-header-rose kelasdiikuti kartu-header-icon">
                  <div class="kartu-icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <h class="kartu-category">Kelas Dibuat</h>
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
                    <i class="fas fa-file"></i>
                  </div>
                  <p class="kartu-category">Modul Publik</p>
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
                    <i class="fas fa-file-archive"></i>
                  </div>
                  <p class="kartu-category">Modul Private</p>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                        Jadwalkan Pertemuan
                    </button>
                  <table class="table table-hover" style="margin-top:10px;">
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
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-kdevent="idevent" data-namaevent="NAMA EVENT" data-kelas="KELAS" data-descevent="DESC EVENT" data-waktuevent="WAKTU EVENT" data-target="#editPertemuan">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusPertemuan">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                      </tr>
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
                  <h4 class="kartu-title">Permintaan Kolaborasi</h4>
                  <p class="kartu-category">Permintaan kolaborasi di kelas yang Anda buat</p>
                </div>
                <div class="kartu-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>No</th>
                      <th>Nama Dosen</th>
                      <th>Nama Kelas</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Rifqi Subagja</td>
                        <td>Alur Framework Code Igniter</td>
                        <td><a href="" class="btn btn-success">Terima</a> &nbsp; <a href="" class="btn btn-danger">Tolak</a></td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Meggy Nurdyansah</td>
                        <td>Full Stack Developer</td>
                        <td><a href="" class="btn btn-success">Terima</a> &nbsp; <a href="" class="btn btn-danger">Tolak</a></td>
                      </tr>
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
          <form action="" class="form-group" id="tambahevent">
            <div class="form-group">
                <label for="">Nama Acara</label>
                <input type='text' class="form-control" name="namacara" placeholder="Masukkan Nama Acara"/>
            </div>
            <div class="form-group">
                <label for="">Deskripsi Acara</label>
                <input type='text' class="form-control" name="desacara" placeholder="Masukkan Deskripsi Acara"/>
            </div>
            <div class="form-group">
                <label for="">Kelas</label>
                <select name="" class="form-control js-example-basic-single">
                    <option value="">Nama Kelas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Tanggal dan Waktu Acara -> Mulai</label>
                <input type='text' class="form-control" id='datetimepicker1' name="waktu_mulai" placeholder="Tanggal dan Waktu Acara" />
            </div>
            <div class="form-group">
                <label for="">Tanggal dan Waktu Acara -> Selesai</label>
                <input type='text' class="form-control" id='datetimepicker2' name="waktu_selesai" placeholder="Tanggal dan Waktu Acara" />
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
