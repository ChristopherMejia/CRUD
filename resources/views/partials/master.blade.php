<!DOCTYPE html>

<html lang="en">
<head>
  <base href="{{ asset('./')}}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Continenal</title>
  <!-- Icons-->
  
  <link rel="stylesheet" href="{{ asset('css/load.css')}}"/>
  <link rel="stylesheet" href="{{ asset('css/coreui.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/all.css')}}">
  <link href="{{ asset('css/simple-line-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('css/style.css')}}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon">
  <link rel="icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon">

  <!-- <link href="css/styles2.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="{{ asset('css/buttons.dataTables.min.css') }}"> <!-- DataTable Buttons-->
  <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
  <link href="{{ asset('vendors/pace-progress/css/pace.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}"> <!--choosen-->
  <link rel="stylesheet" href="{{ asset('css/datatables.css')}}"/>

  <script src="js/jquery.min.js"></script>
  <script src="js/sweetalert.min.js"></script>

  <script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  // Shared ID
  gtag('config', 'UA-118965717-3');
  // Bootstrap ID
  gtag('config', 'UA-118965717-5');
  </script>

  
</head>

<script>
  $(document).ready(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");
  });
</script> 

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <div class="se-pre-con"></div>  
{{--@include('sweet::alert')--}}

@include('partials\navbar')
<div class="app-body">
@include('partials\sidebar')
@yield('content')
</div>

@include('partials\includes')
</body>

</html>
