<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Voluntrr</title>


<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css')}}">
<link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

  <link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/pikaday/pikaday.css') }}">
  <link rel="stylesheet" href="{{ asset('lightbox/css/styles.css') }}">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @stack('styles')
    <style>
        .modal-lg {
        max-width: 90% !important;
}
    </style>
    @livewireStyles

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

      <!-- Navbar -->
@include('layouts.partials.navbar')
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
@include('layouts.partials.sidebar')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        {{$slot}}
      </div>
      <!-- /.content-wrapper -->

      <!-- Main Footer -->
     @include('layouts.partials.footer')
    </div>
    <!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script  src="{{ asset('backend/plugins/jquery/jquery.min.js')}}"></script>

<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('backend/dist/js/adminlte.min.js')}}"></script>
<script src="{{ asset('backend/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{ asset('backend/plugins/toastr/toastr.min.js')}}" ></script>
<script defer src="{{ asset('lightbox/js/script.js')}}"></script>
@stack('js')
{{-- <script src="{{ asset('backend/js/image-zoom.js') }}" type="text/javascript"></script> --}}

{{-- <script>
    $('[x-ref="profileLink"]').on('click', function(){
        localStorage.setItem('_x_currentTab', '"profile"')
    });
    $('[x-ref="changePasswordLink"]').on('click', function(){
        localStorage.setItem('_x_currentTab', '"changePassword"')
    });
    $('[x-ref="listDonasiLink"]').on('click', function(){
        localStorage.setItem('_x_currentTab', '"listDonasi"')
    });
</script> --}}

@stack('before-livewire-scripts')
@livewireScripts
{{-- @stack('after-livewire-scripts') --}}
{{-- @stack('alpine-plugins') --}}
<!-- Alpine Core -->
{{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
</body>
</html>
