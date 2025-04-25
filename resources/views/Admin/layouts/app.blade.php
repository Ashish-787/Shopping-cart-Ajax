<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spica Admin</title>

  <!-- base:css -->
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- endinject -->

  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller d-flex">
    
    <!-- Pro Banner -->
    <div class="row p-0 m-0 proBanner" id="proBanner">
      <div class="col-md-12 p-0 m-0">
        <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
          <div class="ps-lg-1">
            <div class="d-flex align-items-center justify-content-between">
              <p class="mb-0 font-weight-medium me-3 buy-now-text">
                Free 24/7 customer support, updates, and more with this template!
              </p>
              <a href="https://www.bootstrapdash.com/product/spica-admin/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo"
                 target="_blank"
                 class="btn me-2 buy-now-btn border-0">
                Get Pro
              </a>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <a href="https://www.bootstrapdash.com/product/spica-admin/">
              <i class="mdi mdi-home me-3 text-white"></i>
            </a>
            <button id="bannerClose" class="btn border-0 p-0">
              <i class="mdi mdi-close text-white mr-0"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    @include('Admin.layouts.sidebar')
    
    <!-- Page content -->
    <div class="container-fluid page-body-wrapper">
      <!-- Navbar -->
      @include('Admin.layouts.head')

      <!-- Main content -->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>

        <!-- Footer -->
        @include('Admin.layouts.footer')
      </div>
      <!-- End main content -->
    </div>
    <!-- End page-body-wrapper -->
  </div>
  <!-- End container-scroller -->

  <!-- JS scripts -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('js/jquery.cookie.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>
