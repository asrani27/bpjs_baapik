<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  {{--
  <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>BAAPIK</title>
  @include('layouts.css')
  <style>
    .active {
      background-color: #2969b0 !important;
      background-image: linear-gradient(to right, #0954a9, #0785a9, #4db1a5, #2ba79f);
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-lightblue"
      style="background-color: #2969b0 !important; background-image:linear-gradient(to right , #0954a9, #0785a9, #4db1a5, #2ba79f)">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-white">PUSKESMAS {{strtoupper(Auth::user()->name)}}</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar  sidebar-light-lightblue elevation-4">
      <a href="#" class="brand-link navbar-lightblue" style="
      background-color: #0954a9 !important;">
        <span class="brand-text font-weight-light text-white text-CENTER">
          BAAPIK
        </span>
      </a>
      <div class="sidebar">

        @if (Auth::user()->hasRole('superadmin'))
        @include('layouts.menu_superadmin')
        @else

        @endif


      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: #ebfbf7">

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          @yield('content')
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>

    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">
      </div>
      <strong>Copyright &copy; 2022 Banjarmasin</strong>
      <div class="float-right d-none d-sm-inline-block">


      </div>
    </footer>
  </div>

  @include('layouts.js')
</body>

</html>