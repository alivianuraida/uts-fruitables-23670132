<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
  @extends('admin.layouts.head')
</head>

<body>

  <!--start header-->
  @extends('admin.layouts.header')
  <!--end top header-->


   <!--start sidebar-->
    @extends('admin.layouts.sidebar')
<!--end sidebar-->

  <!--start main wrapper-->
  @yield('content')
  <!--end main wrapper-->

  <!--start overlay-->
     <div class="overlay btn-toggle"></div>
  <!--end overlay-->

   <!--start footer-->
   <footer class="page-footer">
    <p class="mb-0">Copyright © 2024. All right reserved.</p>
  </footer>
  <!--end footer-->

  <!--start cart-->
  @extends('admin.layouts.chart')
  <!--end cart-->



  <!--start switcher-->
  @extends('admin.layouts.switcher')
  <!--start switcher-->

  <!--bootstrap js-->
  @extends('admin.layouts.script')

</body>

</html>