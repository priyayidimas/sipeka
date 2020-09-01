@extends('layouts.utama')
@section('title')
Dosen &middot; Detail Kelas
@endsection
@section('heading')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i aria-hidden="true" class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="/dosen/kelas"></i> Kelas</a></li>
            <li class="breadcrumb-item"><a></i> Lihat Kelas - {{$kls->kelas_nama}}</a></li>
        </ol>
    </nav>
@endsection
@section('js')
<script>
    $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".card-mhs").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3 mb-3 menu-kelola">
        <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tugas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Peserta</a>
            </li>
        </ul>
    </div>
    <!-- /.col-md-4 -->
    <div class="col-md-8 menu-kelola-content">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    @foreach($kls->materi()->where('jenis','<>','0')->get() as $k)
                    <div class="col-md-6" style="margin-top:10px;">
                        <div class="card">
                            <div class="card-body">
                                <h5>{{$k->judul}}</h5>
                                <div class="card-text" style="font-size:12px;color:grey;">
                                    <i class="fa fa-clipboard"></i> {{$kls->join()->count()}} Submissions
                                </div>
                                <a href="{{route('listmhssubmis',$k->id)}}" class="btn btn-primary" style="float:right;padding:0px 8px;margin-left:5px;">Lihat Submission</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <br>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="" id="search" class="form-control" placeholder="Cari Mahasiswa ..." id="">
                    </div>
                </div>
                <div class="row">
                    @foreach ($kls->join as $mhs)
                    <div class="col-md-6 card-mhs" style="margin-top:10px;">
                        <div class="card">
                            <div class="card-body">
                                <h5>{{$mhs->fullname}}</h5>
                                <div class="card-text" style="font-size:12px;color:grey;">
                                    {{$mhs->mahasiswa->univ}} <br>
                                    <i class="fa fa-chart-bar"></i> {{$mhs->pivot->progress}}% |
                                    <span style="background:#55DE6B;padding:0px 10px;color:white;border-radius:2px;">Tuntas</span>
                                </div>
                                <a href="" class="btn btn-primary" style="float:right;padding:0px 8px;margin-left:5px;">Lihat Submission</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <br>
            </div>
        </div>
    </div>
    <!-- /.col-md-8 -->
  </div>
@endsection
