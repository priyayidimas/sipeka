<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SiPeka - Sistem Pembelajaran Merdeka</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/sipekawarna.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor-utama/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor-utama/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor-utama/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor-utama/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor-utama/line-awesome/css/line-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor-utama/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor-utama/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <!-- <img src="sipeka.png" width="509px" height="339px" alt=""> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="#hero"><img src="assets/img/sipeka.png" width="82px" height="55px" alt="" class="img-fluid"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="/">Home</a></li>
          <li><a href="/daftar-kelas">Daftar Kelas</a></li>
          <li><a href="">Daftar Dosen</a></li>
          <li><a href="/perpustakaan">Perpustakaan</a></li>
          @if (Auth::check())
          @auth
          <li><a href={{url(session('akses'))}}>{{Auth::user()->fullname}}</a></li>
          @endauth
          @endif
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="fade-up">
      <h1>Perluas Cakrawala untuk Mewujudkan Merdeka Belajar yang Hakiki</h1>
      @if (!Auth::check())
        <div class="row reg">
            <div class="col-md-6">
            <p class="text-white descRegis">Masuk atau daftar sebagai Dosen</p>
            <a href="{{url('login/dosen')}}" class="link-login">
                <button type="button" class="google-buttondsn">
                    <span class="google-button__icon">
                    <svg viewBox="0 0 366 372" xmlns="http://www.w3.org/2000/svg"><path d="M125.9 10.2c40.2-13.9 85.3-13.6 125.3 1.1 22.2 8.2 42.5 21 59.9 37.1-5.8 6.3-12.1 12.2-18.1 18.3l-34.2 34.2c-11.3-10.8-25.1-19-40.1-23.6-17.6-5.3-36.6-6.1-54.6-2.2-21 4.5-40.5 15.5-55.6 30.9-12.2 12.3-21.4 27.5-27 43.9-20.3-15.8-40.6-31.5-61-47.3 21.5-43 60.1-76.9 105.4-92.4z" id="Shape" fill="#EA4335"/><path d="M20.6 102.4c20.3 15.8 40.6 31.5 61 47.3-8 23.3-8 49.2 0 72.4-20.3 15.8-40.6 31.6-60.9 47.3C1.9 232.7-3.8 189.6 4.4 149.2c3.3-16.2 8.7-32 16.2-46.8z" id="Shape" fill="#FBBC05"/><path d="M361.7 151.1c5.8 32.7 4.5 66.8-4.7 98.8-8.5 29.3-24.6 56.5-47.1 77.2l-59.1-45.9c19.5-13.1 33.3-34.3 37.2-57.5H186.6c.1-24.2.1-48.4.1-72.6h175z" id="Shape" fill="#4285F4"/><path d="M81.4 222.2c7.8 22.9 22.8 43.2 42.6 57.1 12.4 8.7 26.6 14.9 41.4 17.9 14.6 3 29.7 2.6 44.4.1 14.6-2.6 28.7-7.9 41-16.2l59.1 45.9c-21.3 19.7-48 33.1-76.2 39.6-31.2 7.1-64.2 7.3-95.2-1-24.6-6.5-47.7-18.2-67.6-34.1-20.9-16.6-38.3-38-50.4-62 20.3-15.7 40.6-31.5 60.9-47.3z" fill="#34A853"/></svg>
                    </span>
                    <span class="google-button__text">Sign in with Google</span>
                </button>
            </a>
            </div>
            <div class="col-md-6">
            <p class="text-white descRegis2">Masuk atau daftar sebagai Mahasiswa</p>
            <a href="{{url('login/mhs')}}" class="link-login">
                <button type="button" class="google-buttonmhs">
                    <span class="google-button__icon">
                    <svg viewBox="0 0 366 372" xmlns="http://www.w3.org/2000/svg"><path d="M125.9 10.2c40.2-13.9 85.3-13.6 125.3 1.1 22.2 8.2 42.5 21 59.9 37.1-5.8 6.3-12.1 12.2-18.1 18.3l-34.2 34.2c-11.3-10.8-25.1-19-40.1-23.6-17.6-5.3-36.6-6.1-54.6-2.2-21 4.5-40.5 15.5-55.6 30.9-12.2 12.3-21.4 27.5-27 43.9-20.3-15.8-40.6-31.5-61-47.3 21.5-43 60.1-76.9 105.4-92.4z" id="Shape" fill="#EA4335"/><path d="M20.6 102.4c20.3 15.8 40.6 31.5 61 47.3-8 23.3-8 49.2 0 72.4-20.3 15.8-40.6 31.6-60.9 47.3C1.9 232.7-3.8 189.6 4.4 149.2c3.3-16.2 8.7-32 16.2-46.8z" id="Shape" fill="#FBBC05"/><path d="M361.7 151.1c5.8 32.7 4.5 66.8-4.7 98.8-8.5 29.3-24.6 56.5-47.1 77.2l-59.1-45.9c19.5-13.1 33.3-34.3 37.2-57.5H186.6c.1-24.2.1-48.4.1-72.6h175z" id="Shape" fill="#4285F4"/><path d="M81.4 222.2c7.8 22.9 22.8 43.2 42.6 57.1 12.4 8.7 26.6 14.9 41.4 17.9 14.6 3 29.7 2.6 44.4.1 14.6-2.6 28.7-7.9 41-16.2l59.1 45.9c-21.3 19.7-48 33.1-76.2 39.6-31.2 7.1-64.2 7.3-95.2-1-24.6-6.5-47.7-18.2-67.6-34.1-20.9-16.6-38.3-38-50.4-62 20.3-15.7 40.6-31.5 60.9-47.3z" fill="#34A853"/></svg>
                    </span>
                    <span class="google-button__text">Sign in with Google</span>
                </button>
            </a>
            </div>
        </div>
      @endif
    </div>
  </section><!-- End Hero -->


  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="" class="about">
      <div class="container review" data-aos="fade-up" style="border-radius: 10px;">
        <br>
        <img src="assets/img/Capture.PNG" class="img-fluid" width="1109px" height="538" alt="">
      </div>
      <div class="tentang" id="about">
        <h1 class="text-center"><b>Tentang</b></h1>
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <p class="text-justify penjelasan">
                SiPeka adalah platform yang memfasilitasi mahasiswa dan dosen untuk melakukan pembelajaran dengan kelas yang lebih luas. SiPeka memungkinkan mahasiswa untuk bergabung di kelas yang tersedia di universitas lain dan dosen dapat memberikan pembelajaran yang lebih menarik.
              </p>
            </div>
            <div class="col-md-6">
              <img src="assets/img/sipekawarna.png" class="logosipeka" width="539px" height="359px" alt="">
            </div>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta" data-aos="fade-in">
      <div class="row">
        <div class="col-md-5 col-sm-12 titleFitur">
          <h1 class="text-white"><b>Fitur</b></h1>
          <p class="text-white">Dapatkan kemudahan belajar dengan SiPeka</p>
        </div>
        <div class="col-md-6 groupItemFitur">
          <div class="row">
            <div class="col-md-6 col-sm-6 fituritem">
              <img src="assets/img/book-open.png" alt="">
              <h4 class="text-white"><b>Perpustakaan</b></h4>
              <p class="text-white">Berisi modul pembelajaran</p>
            </div>
            <div class="col-md-6 col-sm-6 fituritem">
              <img src="assets/img/calendar.png" alt="">
              <h4 class="text-white"><b>Penjadwalan Video Conference</b></h4>
              <p class="text-white">Kebutuhan pertemuan tatap muka</p>
            </div>
            <div class="col-md-6 col-sm-6 fituritem">
              <img src="assets/img/user-plus.png" alt="">
              <h4 class="text-white"><b>Kolaborasi Dosen</b></h4>
              <p class="text-white">Kolaborasi  dosen dalam pembuatan kelas</p>
            </div>
            <div class="col-md-6 col-sm-6 fituritem">
              <img src="assets/img/users.png" alt="">
              <h4 class="text-white"><b>Mentoring dan Diskusi Kelompok</b></h4>
              <p class="text-white">Berdiskusi dengan mahasiswa lain di kelas yang sama</p>
            </div>
            <div class="col-md-6 col-sm-6 fituritem">
              <img src="assets/img/user-plus.png" alt="">
              <h4 class="text-white"><b>Asisten Pengajar</b></h4>
              <p class="text-white">Dosen memilih mahasiswa untuk membantunya</p>
            </div>
            <div class="col-md-6 col-sm-6 fituritem">
              <img src="assets/img/user-check.png" alt="">
              <h4 class="text-white"><b>Monitoring dan Evaluasi</b></h4>
              <p class="text-white">Menjadi lebih baik dengan monitoring dan evaluasi di kelas yang diambil</p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Cta Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>SiPeka</span></strong>. All Rights Reserved
        <span class="float-right">
            <a style="color: rgb(40, 75, 99)" href="{{url('legals/privacy-policy')}}">Privacy Policy</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a style="color: rgb(40, 75, 99)" href="{{url('legals/terms-of-service')}}">Terms of Service</a>
        </span>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor-utama/jquery/jquery.min.js"></script>
  <script src="assets/vendor-utama/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor-utama/jquery.easing/jquery.easing.min.js"></script>
  <!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->
  <script src="assets/vendor-utama/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor-utama/counterup/counterup.min.js"></script>
  <!-- <script src="assets/vendor/venobox/venobox.min.js"></script> -->
  <script src="assets/vendor-utama/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor-utama/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor-utama/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
