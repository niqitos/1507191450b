<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    
    <title>@yield('title')</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/default.css') }}" rel="stylesheet" type="text/css" />
    @yield('head')
</head>
<body>
    <div class="cbc">
        <div class="main">
            @include('layouts.header')
              
            @yield('content')
        </div>
      
        @include('layouts.footer')
    </div>

    @yield('scripts')
</body>
</html>