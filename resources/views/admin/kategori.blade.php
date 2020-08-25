@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="/assets/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
          <div class="row">

            <!-- Area Chart -->
            <div class="col-lg-12 col-md-12">
              <div class="kartu">
                <div class="kartu-header kartu-header-info">
                  <h4 class="kartu-title">Kategori</h4>
                  <p class="kartu-category">Kategori yang tersedia</p>
                </div>
                <div class="kartu-body table-responsive">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                        Tambah Kategori
                    </button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalLong">
                        Tambah Detail Kategori
                    </button>
                  <table class="table table-hover" style="margin-top:10px;">
                    <thead class="text-warning">
                      <th>No</th>
                      <th>Nama Kategori</th>
                      <th>Nama Sub Kategori</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php $n = 1; ?>
                      @foreach ($kategori as $kat)
                        @foreach ($kat->detail_kategori as $dkat)
                            <tr>
                                <td>{{ $n++ }}</td>
                                <td>{{ $kat->kat_nama }}</td>
                                <td>{{ $dkat->dkat_nama }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-kdevent="idevent" data-namaevent="NAMA EVENT" data-kelas="KELAS" data-descevent="DESC EVENT" data-waktuevent="WAKTU EVENT" data-target="#editPertemuan">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusPertemuan">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
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
          <form action="{{url('')}}" class="form-group" id="tambahevent">
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
                <label for="">Tanggal dan Waktu Acara</label>
                <input type='text' class="form-control" id='datetimepicker1' name="waktu" placeholder="Tanggal dan Waktu Acara" />
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
