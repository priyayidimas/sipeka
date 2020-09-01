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
            </ul>
            <h6 style="margin:0px 10px;"><b>Materi</b></h6>
            <ul class="list-unstyled components">
                @foreach($mt as $m)
                <li class="{{ ($m->id == $id) ? 'active' : '' }}">
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

            <h2>{{$show->judul}}</h2>
            <p>{{$show->desc}}</p>

            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-center">Modul Pendukung</h6>
                    <div class="row">
                        <div class="col-md-2">
                            <i class="fa fa-file" style="font-size:50px;"></i>
                        </div>
                        <div class="col-md-8">
                            @if($show->filemodul != NULL)
                            <a href="/storage/modul/{{$show->filemodul}}" target="blank">{{$show->filemodul}}</a><br>
                            <a href="" class="btn-downloadmodul"><i class="fa fa-download"></i>&nbsp;&nbsp;Download Modul</a>
                            @else <span style="font-size:14px;">Tidak Ada Modul</span> @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="border-left: 1px solid grey;">
                    <h6 class="text-center">Jenis Materi</h6>
                    <div class="row">
                        <div class="col-md-2">
                            <i class="fa fa-clipboard" style="font-size:50px;"></i>
                        </div>
                        <div class="col-md-8">
                            <span style="font-size:14px;">@if($show->jenis == 0)Materi @elseif($show->jenis == 1)Pertanyaan @else Materi dan Pertanyaan @endif</span>
                        </div>
                    </div>
                </div>
            </div>
            @if($show->idytb)
            <div class="line"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$show->idytb}}" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            @endif
            @if($show->jenis == 1 || $show->jenis == 2)
            <div class="line"></div>
            @php $jawaban = $show->jawaban()->where('id_mhs',Auth::id());@endphp
            @if ($jawaban->count() > 0)
            <div class="row">
                <div class="col-12">
                    <h6>Jawaban Anda</h6>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <b>Deskripsi:</b>
                                    <p>{{$jawaban->first()->pivot->jawaban_text}}</p>
                                    <a href="#jawabEditModal" data-toggle="modal" class="btn btn-warning">Edit Jawaban</a>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <a class="btn btn-primary" href="{{url('storage/jawaban/'.$jawaban->first()->pivot->jawaban_file)}}">Lampiran File</a><br><br>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('jmateri',$kls->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="idm" value="{{$show->id}}">
                        <div class="form-group">
                            <label for="">Jawaban</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="jawab_text" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">File Jawaban</label>
                            <input type="file" class="form-control-file" name="jawab_file" id="exampleFormControlFile1">
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-primary" value="Submit" id="exampleFormControlFile1">
                        </div>
                    </form>
                </div>
            </div>
            @endif
            @endif
        </div>
    </div>

    <div class="modal-only">
        <div class="modal fade" id="jawabEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Ubah Jawaban</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('jedit')}}" class="form-group" id="jawabEdit" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="idm" value="{{$show->id}}">
                      <div class="form-group">
                          <label for="">Jawaban</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" name="jawab_text" rows="4"></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleFormControlFile1">File Jawaban</label>
                          <input type="file" class="form-control-file" name="jawab_file" id="exampleFormControlFile1">
                      </div>
                  </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" onclick="event.preventDefault(); document.getElementById('jawabEdit').submit();" class="btn btn-primary">Submit</button>
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
        });
    </script>
</body>

</html>
