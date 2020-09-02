@extends('layouts.utama')

@section('title')
Dosen &middot; Akhiri Kelas
@endsection

@section('heading')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i aria-hidden="true" class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="/dosen/kelas"></i> Kelas</a></li>
            <li class="breadcrumb-item"><a></i> Akhiri Kelas - {{$kls->kelas_nama}}</a></li>
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
@endsection

@section('content')
<div class="row">
    <div class="col-md-11 menu-kelola-content p-4">
        <h5>List Tugas</h5>
        <form action="{{url('dosen/kelas/selesai')}}" method="POST" id="akhirKelas">
            @csrf
            <input type="hidden" name="jmlTugas" value="{{$kls->materi()->where('jenis','<>','0')->count()}}">
            <table class="table">
                <thead>
                    <th>Nama Materi</th>
                    <th>Jumlah Submission</th>
                    <th>Bobot</th>
                </thead>
                @foreach($kls->materi()->where('jenis','<>','0')->get() as $k)
                @php
                    $cSubs = $k->jawaban()->count();
                @endphp
                <tr>
                    <td><a href="{{url('dosen/kelas/list-submission/'.$k->id)}}">{{$k->judul}}</a></td>
                    <td>{{$cSubs}}</td>
                    <td>
                        <input type="number" step="0.05" min="0" max="1" class="form-control" name="bobot[{{$k->id}}]" required>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="form-group text-right">
                <a href="#akhirKelasModal" data-toggle="modal" class="btn btn-success">Akhiri Kelas</a>
            </div>
    </div>
</div>
<section id="modals-only">
    <div class="modal fade" id="akhirKelasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Akhiri Kelas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <h5 class="text-center">Anda yakin ingin mengakhiri kelas ini? Nilai akhir mahasiswa akan ditentukan dan tidak dapat diubah lagi</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Lanjutkan</button>
            </div>
        </div>
      </div>
    </div>
</section>
</form>
@endsection
