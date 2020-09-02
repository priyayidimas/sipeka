<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SiPeka - Sistem Pembelajaran Merdeka</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">
  <meta name="dicoding:email" content="priyayidimas@upi.edu">

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
      <h1 style="margin-top:100px;">Daftar Dosen</h1>
      <p style="color:white;">Bergabung sekarang juga dengan pengajar-pengajar terbaik dengan keilmuan yang berbeda.</p>
    </div>
  </section><!-- End Hero -->

  <main id="main" style="margin-top: 200px;">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{url('')}}" style="color:#284B63;">Home</a></li>
          <li><b>Daftar Dosen</b></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="" placeholder="Cari Dosen ..." class="form-control" id="search">
            </div>
        </div>
        <div class="row" style="margin-top:20px;">
          @php $n = 1; @endphp
          @foreach ($dosen as $data)
          <div class="col-lg-3 col-md-12 blogBox moreBox" {!! ($n>4) ? 'style="display: none;"' : '' !!}>
            <div class="member" data-aos="fade-up">
              <div class="member-img">
                <img src="{{$data->avatar}}" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <h4>{{$data->fullname}}</h4>
                <span>{{$data->dosen->univ}}</span>
                <a href="{{url('detail-dosen/'.$data->id)}}" class="btn btn-info">Detail Dosen</a>
              </div>
            </div>
          </div>
          @php $n++; @endphp
          @endforeach
        </div>
        @if ($n > 4)
        <div id="loadMore" style="">
            <a href="#">Load More</a>
        </div>
        @endif
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

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

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
            $(".blogBox").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
	});
  </script>

</body>

</html>
