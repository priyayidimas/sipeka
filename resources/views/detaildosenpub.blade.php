{{-- TODO Ini Modal Kenapa --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SiPeka - Sistem Pembelajaran Merdeka</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{url('assets/img/sipekawarna-min.png')}}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{url('assets/vendor-utama/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor-utama/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor-utama/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor-utama/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor-utama/line-awesome/css/line-awesome.min.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor-utama/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor-utama/aos/aos.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{url('assets/css/style.css')}}" rel="stylesheet">
  <style>
    #loadMore {
    padding-bottom: 30px;
    padding-top: 30px;
    text-align: center;
    width: 100%;
    }
    #loadMore a {
        background: #042a63;
        border-radius: 3px;
        color: white;
        display: inline-block;
        padding: 10px 30px;
        transition: all 0.25s ease-out;
        -webkit-font-smoothing: antialiased;
    }
  </style>

  <!-- =======================================================
  * Template Name: Serenity - v2.1.0
  * Template URL: https://bootstrapmade.com/serenity-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <!-- <img src="sipeka.png" width="509px" height="339px" alt=""> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="index.html"><img src="sipeka.png" width="82px" height="55px" alt="" class="img-fluid"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/daftar-kelas">Daftar Kelas</a></li>
            <li><a href="">Daftar Dosen</a></li>
            <li><a href="/perpustakaan">Perpustakaan</a></li>
            @auth
            <li><a href="{{url(session('akses'))}}">{{Auth::user()->fullname}}</a></li>
            @endauth
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <section id="hero" style="height: 400px;">
    <div class="hero-container" data-aos="fade-up">
      <h1 class="text-capitalize" style="margin-top:100px;">{{$dosen->fullname}}</h1>
    </div>
  </section><!-- End Hero -->

  <main id="main" style="margin-top: 200px;">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{url('')}}" style="color:#284B63;">Home</a></li>
          <li><a href="{{url('daftar-dosen')}}" style="color:#284B63;">Daftar Dosen</a></li>
          <li class="text-capitalize"><b>Dosen - {{$dosen->fullname}}</b></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">
        <div class="row" data-aos="fade-up">
          <div class="col-md-3">
              <div class="member" style="background: #FFFFFF;
              box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
              border-radius: 5px;padding: 10px;" data-aos="fade-up">
                <div class="member-img" style="border-radius:5px;">
                  <img src="{!! $dosen->avatar !!}" class="img-fluid" alt="">
                </div>
                <div class="member-info text-center">
                  <h4 class="text-capitalize">{{$dosen->fullname}}</h4>
                  <span style="color:grey;font-weight: 600;font-size:12px;">{{$dosen->dosen->univ}}</span>
                  <span style="color:grey;font-weight: 600;font-size:12px;">{{$dosen->dosen->prodi}}</span>
                  @if (Auth::check() && Auth::user()->level > 0)
                  <button class="btn btn-primary" data-toggle="modal" data-target="#inviteKolabModal">Undang</button>
                  @endif
                </div>
              </div>
          </div>
          <div class="col-md-9">
            <h3 style="font-family: merriweather,serif;letter-spacing: .2px;font-weight: 600;text-align: center;">Daftar Kelas</h3>
            <div class="row" style="margin-top: 50px;">
              <div class="col-md-6">
                <input type="text" name="" placeholder="Cari Kelas ..." class="form-control" id="search">
              </div>
            </div>
            <div class="row">
            @php $n = 1; @endphp
            @foreach ($dosen->kelas as $kelas)
            <div class="col-md-6 blogBox moreBox card-kelas" style="margin-top: 20px;{{($n > 4) ? 'display: none' : ''}} ">
                <div class="card">
                <div class="card-body">
                    <span style="font-size:12px;color:grey;"><b>{{$kelas->detail_kategori->dkat_nama}}</b></span>
                    <div class="card-title"><h5><b>{{$kelas->kelas_nama}}</b></h5></div>
                    <p style="text-align:justify;font-size:14px;font-weight: 500;">{{$kelas->desc}}</p>
                    @if(Auth::check() && Auth::user()->level == 0)
                    <form action="{{url('mhs/kelas/join-kelas')}}" method="post" class="form-group" id="j-kelas">
                        @csrf
                        <input type="hidden" name="idkelas" value="{{$kelas->id}}">
                    </form>
                    <a href onclick="event.preventDefault(); document.getElementById('j-kelas').submit();" style="float:right" class="btn btn-info">Daftar Kelas</a>
                    @elseif(!Auth::check())
                    <a href="{{url('login/mhs')}}" style="float:right" class="btn btn-info">Login Untuk Daftar</a>
                    @endif
                </div>
                </div>
            </div>
            @php $n++; @endphp
            @endforeach
            @if ($n > 4)
            <div id="loadMore" style="">
                <a href="#">Load More</a>
            </div>
            @endif
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Team Section -->


  </main><!-- End #main -->

 <!-- ======= Footer ======= -->
 <footer id="footer">

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>SiPeka</span></strong>. All Rights Reserved
    </div>
  </div>
</footer><!-- End Footer -->

@if (Auth::check() && Auth::user()->level > 0)
    <section id="modal-only">
        <div class="modal fade" id="inviteKolabModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Undang Kolaborator</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{url('dosen/invite')}}" class="form-group" id="inviteKolab">
                      @csrf
                      <input type="hidden" name="dosen_id" value="{{$dosen->id}}">
                      <div class="form-group">
                        <label for="">Undang Ke Kelas</label>
                        <select name="kelas_id" id="" class="form-control js-example-basic-single" required>
                            <option disabled value="">Pilih Kelas</option>
                            @foreach(Auth::user()->kelas as $kelas)
                            <option value="{{$kelas->id}}">{{$kelas->kelas_nama}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Untuk Menjadi</label>
                        <select name="akses" id="" class="form-control js-example-basic-single" required>
                            <option disabled value="">Pilih Akses</option>
                            <option value="0">Reviewer</option>
                            <option value="1">Dosen Pendamping</option>
                        </select>
                      </div>
                  </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" onclick="event.preventDefault(); document.getElementById('inviteKolab').submit();" class="btn btn-primary">Submit</button>
                  </div>
              </div>
            </div>
        </div>
    </section>
@endif

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <!-- Vendor JS Files -->
  <script src="{{url('assets/vendor-utama/jquery/jquery.min.js')}}"></script>
  <script src="{{url('assets/vendor-utama/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('assets/vendor-utama/jquery.easing/jquery.easing.min.js')}}"></script>
  <!-- <script src="{{url('assets/vendor/php-email-form/validate.js')}}"></script> -->
  <script src="{{url('assets/vendor-utama/waypoints/jquery.waypoints.min.js')}}"></script>
  <script src="{{url('assets/vendor-utama/counterup/counterup.min.js')}}"></script>
  <!-- <script src="{{url('assets/vendor/venobox/venobox.min.js')}}"></script> -->
  <script src="{{url('assets/vendor-utama/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{url('assets/vendor-utama/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{url('assets/vendor-utama/aos/aos.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{url('assets/js/main.js')}}"></script>
  <script>
    $( document ).ready(function () {
      $(".moreBox").slice(0, 4).show();
      if ($(".blogBox:hidden").length != 0) {
        $("#loadMore").show();
      }
      $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".moreBox:hidden").slice(0, 4).slideDown();
        if ($(".moreBox:hidden").length == 0) {
          $("#loadMore").fadeOut('slow');
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
