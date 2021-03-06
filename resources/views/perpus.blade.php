<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="dicoding:email" content="priyayidimas@upi.edu">

    <title>SiPeka - Sistem Pembelajaran Merdeka</title>

    <link href="{{url('assets/img/sipekawarna-min.png')}}" rel="icon">


    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{url('assets/css/listkelas.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    @if(Auth::check())
                    <a href="{{url(''.session('akses'))}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    @else
                    <a href="/" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    @endif
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                @if(Auth::check())
                                <a class="nav-link" href="{{url(''.session('akses'))}}">Home</a>
                                @else
                                <a class="nav-link" href="{{url('/')}}">Home</a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if(Auth::check())
                                <a class="nav-link" href="{{url(''.session('akses').'/kelas')}}">Kelas</a>
                                @else
                                <a class="nav-link" href="/daftar-kelas">Kelas</a>
                                @endif
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

            <div class="row">
                <div class="col-sm-12">
                  <div class="card text-white kelasheader">
                    <div class="card-body">
                      <h3 class="card-title" style="font-weight:700;">Perpustakaan</h3>
                      <p class="card-text text-white">Perpustakaan ini menjadi tempat terkumpulnya modul-modul yang dibuat atau disediakan untuk mendukung proses belajar.</p>
                    </div>
                  </div>
                </div>
              </div>

            <div class="line"></div>

            <div class="row">
              <div class="col-md-4 filter">
                <form action="">
                  <div class="card">
                    <div class="card-body">
                        <h5 style="margin-left:15px"><b>Filter</b></h5>
                          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @foreach($kat as $k)
                            <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#dataKat{{$k->id}}" aria-expanded="true" aria-controls="collapseOne">
                                    {{$k->kat_nama}}<i class="fa fa-angle-down"></i>
                                  </a>
                                </h4>
                              </div>
                              <div id="dataKat{{$k->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    @foreach($k->detail_kategori as $cu)
                                    <label>
                                      <input type="checkbox" rel="dkat{{$cu->id}}" />
                                      {{$cu->dkat_nama}}
                                    </label><br>
                                    @endforeach
                                </div>
                              </div>
                            </div>
                            @endforeach
                          </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-md-8 searchform">
                  <div class="row">
                    <div class="col-md-6">
                      <form action="">
                        <div class="form-group has-search">
                          <span class="fa fa-search form-control-feedback"></span>
                          <input type="text" id="search" class="form-control" placeholder="Cari Modul ...">
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="row allclass">
                    @foreach($m as $k)
                    <div class="col-md-6 card-kelas dkat{{$k->detail_kategori->id}}">
                      <div class="card">
                        <div class="card-body cekcik">
                          <h6 class="card-subtitle mb-2 text-muted kat">{{$k->detail_kategori->dkat_nama}}</h6>
                          <h6 class="card-title">{{$k->judul}}</h6>
                          <p class="infokelas"><i class="fa fa-user"></i>&nbsp;{{$k->dosen->fullname}}</p>
                          <div class="text-right">

                            <a href="/storage/modul/{{$k->filename}}" class="btndaftar" target="blank">Lihat Modul</a>

                            <!-- Sudah Bergabung -->
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
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

            $('.panel-collapse').on('show.bs.collapse', function () {
              $(this).siblings('.panel-heading').addClass('active');
            });

            $('.panel-collapse').on('hide.bs.collapse', function () {
              $(this).siblings('.panel-heading').removeClass('active');
            });

            $('div.panel-body').find('input:checkbox').click(function () {
                if($('div.panel-body').find('input:checked').length > 0){
                	$('.allclass > div').hide();
                  $('div.panel-body').find('input:checked').each(function () {
                    $('.allclass > div.' + $(this).attr('rel')).show();
                  });
                }else{
                	$('.allclass > div').show();
                }
            });

            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".card-kelas").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

                  });
    </script>
</body>

</html>
