<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>@yield('title') - Admin</title>
      <!-- Custom fonts for this template-->
      <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

      <!-- Custom styles for this template-->
      <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
      <link href="{{ asset('admin/vendor/toastr/toastr.min.css') }}" rel="stylesheet">
      <!-- datatable css -->      
      @yield('styles')
   </head>
   <body id="page-top">      
      
      {{-- <span style="display: none;" id="{{Auth::user()->id}}" name="{{Auth::user()->username}}" class="info_user"></span> --}}
      <!-- Page Wrapper -->
      <div id="wrapper">
         <!-- Sidebar -->
         @include('layouts.__sidebar')
         <!-- End of Sidebar -->
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
               <!-- Topbar -->
               @include('layouts.__topbar')
               <!-- End of Topbar -->
               <!-- Begin Page Content -->
               <div class="se-pre-con"></div>
               @yield('content')
               <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            @include('layouts.__footer')
            <!-- End of Footer -->
         </div>
         <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
      </a>
      
      
      <!-- Bootstrap core JavaScript-->
      <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

      <!-- Core plugin JavaScript-->
      <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

      <!-- Custom scripts for all pages-->
      <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
      <script src="{{ asset('admin/vendor/toastr/toastr.min.js') }}"></script>

      <script src="{{ asset('admin/vendor/loadingModal/jquery.loadingModal.js') }}"></script>
      <script src="{{ asset('admin/vendor/loadingModal/run.js') }}"></script>
  
      @yield('scripts')
      @include('layouts.message.message')
   </body>
</html>