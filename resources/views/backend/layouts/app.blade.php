<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Lite</title>

  @include('backend.layouts.css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper mt-5">


   @include('backend.layouts.navbar')

   @include('backend.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="app">    
    @yield('content')

  </div>
  <!-- /.content-wrapper -->

   @include('backend.layouts.footer')

</div>
<!-- ./wrapper -->

    @include('backend.layouts.scripts')

</body>
</html>