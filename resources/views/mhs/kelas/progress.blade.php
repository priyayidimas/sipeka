<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Kelas - {{$kls->kelas_nama}}</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="/assets/css/materi.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="/mhs/kelas" class="btn btn-primary back">Kembali</a>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="{{route('lihat-kelas',$kls->kelas_kode)}}"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Informasi Kelas</a>
                </li>
                <li class="active">
                    <a href="{{route('progressKelasMhs',$kls->kelas_kode)}}"><i class="fas fa-chart-bar"></i>&nbsp;&nbsp;Progress</a>
                </li>
            </ul>
            <h6 style="margin:0px 10px;"><b>Materi</b></h6>
            <ul class="list-unstyled components">
                @foreach($mt as $m)
                <li>
                    <a href="{{route('lmateri',['idkelas' => $kls->kelas_kode, 'id' => $m->id])}}">{{$m->judul}}</a>
                </li>
                @endforeach
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/mhs">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/mhs/kelas">Kelas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/mhs/perpustakaan">Perpustakaan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            @if(Session::get('msg'))
              <div class="alert alert-{!! Session::get('color') !!} alert-dismissible fade show" role="alert">
              {!! Session::get('msg') !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
            @endif

            <h2>Progress Kelas</h2>

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
                            $jawaban = $k->jawaban()->where('id_mhs',Auth::id())->first();
                            $status = '<span class="badge badge-danger">Belum Dikerjakan</span>';
                            if($jawaban){
                                $status = '<span class="badge badge-success">Sudah Dikerjakan</span>';
                                $n++;
                            }
                        @endphp
                        <tr>
                            <td>{{$k->judul}}</td>
                            <td>{!! $status !!}</td>
                            <td>
                                @if (!$jawaban)
                                <a class="btn btn-primary" href="{{route('lmateri',['idkelas' => $kls->kelas_kode, 'id' => $k->id])}}">Kerjakan</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <h5>Tugas Dikumpulkan : {{$n}} / {{$cAll}} ({{ ($cAll != 0) ? ($n/$cAll) * 100 : '0' }}%) </h5>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
</body>

</html>
