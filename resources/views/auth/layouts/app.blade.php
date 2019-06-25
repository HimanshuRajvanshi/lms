<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>TrilaSoft</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('backEnd/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backEnd/fonts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backEnd/css/animate.min.css') }}" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="{{ asset('backEnd/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('backEnd/css/icheck/flat/green.css') }}" rel="stylesheet">
    <script src="{{ asset('backEnd/js/jquery.min.js') }}"></script>
    
</head>
<body style="background:#F7F7F7;">
    <div class="">
      <a class="hiddenanchor" id="toregister"></a>
      <a class="hiddenanchor" id="tologin"></a>
    </div>
  
        <main class="py-4">
            @yield('content')
        </main>
</body>
</html>
