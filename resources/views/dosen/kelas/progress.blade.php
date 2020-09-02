@extends('layouts.utama')

@section('title')
Dosen &middot; Progress Mahasiswa
@endsection

@section('heading')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i aria-hidden="true" class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="/dosen/kelas"></i> Kelas</a></li>
            <li class="breadcrumb-item"><a></i> Progress Mahasiswa - {{$mhs->fullname}}</a></li>
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
        <h5>List Tugas</h5><br>
        <table class="table">
            <thead>
                <th>Nama Materi</th>
                <th>Status Submission</th>
                <th>Aksi</th>
            </thead>
            @php
                $cAll = $kls->materi()->where('jenis','<>','0')->count();
                $n = 0;
            @endphp
            @foreach($kls->materi()->where('jenis','<>','0')->get() as $k)
            @php
                $jawaban = $k->jawaban()->where('id_mhs',$mhs->id)->first();
                $status = 'Belum Dikerjakan';
                if($jawaban){
                    $status = 'Sudah Dikerjakan';
                    $n++;
                }
            @endphp
            <tr>
                <td><a href="{{url('dosen/kelas/list-submission/'.$k->id)}}">{{$k->judul}}</a></td>
                <td>{{$status}}</td>
                <td>
                    @if ($jawaban)
                    <a class="btn btn-primary" href="{{url('dosen/kelas/periksa/'.$jawaban->pivot->id)}}">Periksa</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>

        <h5>Tugas Dikumpulkan : {{$n}} / {{$cAll}} ({{ ($n/$cAll) * 100 }}%) </h5>
    </div>
</div>
@endsection
