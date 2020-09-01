@php
    $user = Auth::user();
    $bio = ($user->level == 0) ? $user->mahasiswa : $user->dosen;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>
  <link href="{{url('assets/img/sipekawarna-min.png')}}" rel="icon">

  <!-- Custom fonts for this template-->
  <link href="{{url('/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/assets/css/sb-admin-2.css" rel="stylesheet">
    @yield('css')
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon" style="margin-top: 50px;">
          <img class="img-profile rounded-circle" src="{!! $user->avatar !!}" width="60" height="60">
        </div>
      </a>
      <div style="margin-top: 30px;" class="text-center prfl"><b>{{ $user->fullname }}</b></div>
      <div class="text-center prfl">{{ $bio->univ }}</div>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <div class="group-nav-item">
        <li class="nav-item {{ (request()->is('dosen') || request()->is('mhs')) ? 'active' : '' }}">
          <a class="nav-link" href="{{url(''.session('akses'))}}">
            <div class="c {{ (request()->is('dosen') || request()->is('mhs')) ? 'c-active' : '' }}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </div>
          </a>
        </li>
        <li class="nav-item {{ (request()->is('dosen/kelas*') || request()->is('mhs/kelas*')) ? 'active' : '' }}">
          <a class="nav-link" href="{{url(''.session('akses').'/kelas')}}">
            <div class="c {{ (request()->is('dosen/kelas*') || request()->is('mhs/kelas*')) ? 'c-active' : '' }}">
              <i class="fas fa-fw fa-users"></i>
              <span>Kelas</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url(''.session('akses').'/perpustakaan')}}">
            <div class="c">
              <i class="fas fa-fw fa-book"></i>
              <span>Perpustakaan</span>
            </div>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="{{url('chat')}}">
            <div class="c">
              <i class="fas fa-fw fa-comments"></i>
              <span>Group Chat</span>
            </div>
          </a>
        </li> --}}
      </div>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $user->fullname }}</span>
                <img class="img-profile rounded-circle" src="{!! $user->avatar !!}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{url(''.session('akses').'/profile')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          @yield('heading')
          @if(Session::has('msg'))
              <div class="alert alert-{!! Session::get('color') !!} alert-dismissible fade show" role="alert">
              {!! Session::get('msg') !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
          @endif
          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; SiPeka 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik "logout" jika Anda akan keluar dari akun Anda.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{url('logout')}}">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
@yield('js')
  <script src="https://unpkg.com/feather-icons"></script>
  <script>
      feather.replace()
    </script>

  <!-- Custom scripts for all pages-->
  <script src="/assets/js/sb-admin-2.js"></script>

</body>

</html>
