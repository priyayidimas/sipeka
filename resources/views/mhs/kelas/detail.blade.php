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
                <li class="active">
                    <a href="{{route('lihat-kelas',$kls->kelas_kode)}}"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Informasi Kelas</a>
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

            <h2>{{$kls->kelas_nama}}</h2>
            <p class="text-justify">{{$kls->desc}}</p>

            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-center">Informasi Dosen</h6>
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{$kls->dosen->avatar}}" class="rounded-circle" width="50" height="50" alt="">
                        </div>
                        <div class="col-md-8">
                            <h6><b>{{$kls->dosen->fullname}}</b></h6>
                            <p>{{$kls->dosen->dosen->univ}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="border-left: 1px solid grey;">
                    <h6 class="text-center">Informasi Kelas</h6>
                    <div class="row">
                        <div class="col-md-2">
                            <i class="fa fa-clipboard" style="font-size:50px;"></i>
                        </div>
                        <div class="col-md-8">
                            <span style="font-size:14px;"><b>Kategori : </b> {{$kls->detail_kategori->dkat_nama}}</span><br>
                            <span style="font-size:14px;"><b>Jumlah Materi : </b> {{$kls->materi()->count()}} Materi</span><br>
                            @if($kls->link_tel != NULL)<a href="{{$kls->link_tel}}" class="btn btn-primary" style="padding:2px 5px;"> Join Group</a>@else <span class="alert alert-info" style="padding:1px;">Tidak Ada Group Telegram</span>@endif
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    @if ($kls->kolab()->where('akses','1')->count() > 0)
                    <h6 class="text-center">Dosen Pendamping</h6>
                    @foreach ($kls->kolab()->where('akses','1')->get() as $kolab)
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{$kolab->avatar}}" class="rounded-circle" width="50" height="50" alt="">
                        </div>
                        <div class="col-md-8">
                            <h6><b>{{$kolab->fullname}}</b></h6>
                            <p>{{$kolab->dosen->univ}}</p>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="col-md-6" style="border-left: 1px solid grey;">
                    @if ($kls->kolab()->where('akses','0')->count() > 0)
                    <h6 class="text-center">Reviewer</h6>
                    @foreach ($kls->kolab()->where('akses','0')->get() as $kolab)
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{$kolab->avatar}}" class="rounded-circle" width="50" height="50" alt="">
                        </div>
                        <div class="col-md-8">
                            <h6><b>{{$kolab->fullname}}</b></h6>
                            <p>{{$kolab->dosen->univ}}</p>
                        </div>
                    </div>
                    @endforeach
                    @endif
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
