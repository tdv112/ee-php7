<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('EE/images/favicon.ico')}}">
    <title>Sàn tuyển dụng trực tuyến hàng đầu việt nam!</title>
    <meta name="description" content="Tin tức tuyển dụng nhanh trực tuyến">
    <meta name="keywords" content="Tin tức tuyển dụng trực tuyến">
    <meta name="author" content="Trần Đại">
    <meta name="copyright" content="Copyright (c) by ee.vn LLC. All rights reserved.">
    <meta name="robots" content="index, follow, noodp, noarchive">
    <meta name="googlebot" content="index, follow, noodp, noarchive">
    <meta name="lang uage" content="vi_VN">
    <meta itemprop="name" content="">
    <meta itemprop="description" content="Tin tức tuyển dụng nhanh trực tuyến">

    <meta itemprop="image" content="{{asset('EE/images/logo-introhome.png')}}">

    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('EE/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('EE/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('EE/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('EE/css/summernote.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('EE/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('EE/css/responsive.css')}}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('EE/css/loader.css')}}">
    

    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://dev.congviecthoivu.com/bootstrap/js/html5shiv.min.js"></script>
    <script type="text/javascript" src="http://dev.congviecthoivu.com/bootstrap/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        var BASE_URL = '/';
    </script>
</head>
<body>
<div id="background"><div class="stretch"></div></div>
<div class="container1">
    @include('layouts.partials.header')
    {{--content--}}
    @yield('content')
     <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>
</div>
</body>
<script type="text/javascript" src="{{asset('EE/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('EE/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('EE/js/moment.js')}}"></script>
<script type="text/javascript"
        src="{{asset('EE/js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('EE/js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('EE/js/summernote.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-fqovGW58beA6DW3WYZqHxYLTnbib0I4&libraries=places&callback=initialize" async defer></script>
{{-- <script type="text/javascript" src="{{asset('EE/js/responsive.js')}}"></script> --}}
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-fqovGW58beA6DW3WYZqHxYLTnbib0I4&libraries=places&callback=eemap" async defer></script> --}}
<script src="{{ asset('EE/js/EE-library.js') }}"></script>

<script type="text/javascript">
  var loader = function() {
    setTimeout(function() { 
      if($('#loader').length > 0) {
        $('#loader').removeClass('show');
      }
    }, 0);
  };
  loader();
</script>

</html>
