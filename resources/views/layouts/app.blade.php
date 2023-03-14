<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Hello' }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}"> 
    <script src="{{ asset('js/bootstrap.bundle.js') }}" defer></script>
</head>
<body class="bg-light">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      @auth
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      @endauth
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      @auth
      <li class="nav-item">
        <form action="{{ route('logout') }}" method="post" class="inline p-3">
          @csrf
          <button type="submit">Logout</button>
        </form>
      </li>
      @endauth
    </ul>
  </nav>
  <!-- /.navbar -->
      @include('left-menu.sidebar')
      @yield('content')
      <!-- jQuery -->
      <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
      <script>
        $.widget.bridge('uibutton', $.ui.button)
      </script>
      <!-- Sparkline -->
      <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
       <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src={{ asset("js/adminlte.js") }}></script>
</body>
</html>