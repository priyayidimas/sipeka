@extends('layouts.utama')

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
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Submission</a>
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
                    <div class="col-md-6" style="margin-top:10px;">
                        <div class="card">
                            <div class="card-body">
                                <h5>Nama Materi</h5>
                                <div class="card-text" style="font-size:12px;color:grey;">
                                    <i class="fa fa-clipboard"></i> 9 Submissions
                                </div>
                                <a href="" class="btn btn-primary" style="float:right;padding:0px 8px;margin-left:5px;">Lihat Submission</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top:10px;">
                        <div class="card">
                            <div class="card-body">
                                <h5>Nama Materi</h5>
                                <div class="card-text" style="font-size:12px;color:grey;">
                                    <i class="fa fa-clipboard"></i> 9 Submissions
                                </div>
                                <a href="" class="btn btn-primary" style="float:right;padding:0px 8px;margin-left:5px;">Lihat Submission</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top:10px;">
                        <div class="card">
                            <div class="card-body">
                                <h5>Nama Materi</h5>
                                <div class="card-text" style="font-size:12px;color:grey;">
                                    <i class="fa fa-clipboard"></i> 9 Submissions
                                </div>
                                <a href="" class="btn btn-primary" style="float:right;padding:0px 8px;margin-left:5px;">Lihat Submission</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top:10px;">
                        <div class="card">
                            <div class="card-body">
                                <h5>Nama Materi</h5>
                                <div class="card-text" style="font-size:12px;color:grey;">
                                    <i class="fa fa-clipboard"></i> 9 Submissions
                                </div>
                                <a href="" class="btn btn-primary" style="float:right;padding:0px 8px;margin-left:5px;">Lihat Submission</a>
                            </div>
                        </div>
                    </div>
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
                    <div class="col-md-6 card-mhs" style="margin-top:10px;">
                        <div class="card">
                            <div class="card-body">
                                <h5>Nama Mahasiswa</h5>
                                <div class="card-text" style="font-size:12px;color:grey;">
                                    Universitas Pendidikan Indonesia <br>
                                    <i class="fa fa-chart-bar"></i> 100% |
                                    <span style="background:#55DE6B;padding:0px 10px;color:white;border-radius:2px;">Tuntas</span>
                                </div>
                                <a href="" class="btn btn-primary" style="float:right;padding:0px 8px;margin-left:5px;">Lihat Submission</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 card-mhs" style="margin-top:10px;">
                        <div class="card">
                            <div class="card-body">
                                <h5>Ujang</h5>
                                <div class="card-text" style="font-size:12px;color:grey;">
                                    Universitas Pendidikan Indonesia <br>
                                    <i class="fa fa-chart-bar"></i> 100% |
                                    <span style="background:#55DE6B;padding:0px 10px;color:white;border-radius:2px;">Tuntas</span>
                                </div>
                                <a href="" class="btn btn-primary" style="float:right;padding:0px 8px;margin-left:5px;">Lihat Submission</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 card-mhs" style="margin-top:10px;">
                        <div class="card">
                            <div class="card-body">
                                <h5>Nama Mahasiswa</h5>
                                <div class="card-text" style="font-size:12px;color:grey;">
                                    Universitas Pendidikan Indonesia <br>
                                    <i class="fa fa-chart-bar"></i> 100% |
                                    <span style="background:#55DE6B;padding:0px 10px;color:white;border-radius:2px;">Tuntas</span>
                                </div>
                                <a href="" class="btn btn-primary" style="float:right;padding:0px 8px;margin-left:5px;">Lihat Submission</a>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
    <!-- /.col-md-8 -->
  </div>
@endsection