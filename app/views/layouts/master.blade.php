<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Cyclingcols</title>
        <link rel="stylesheet" href="{{ URL::asset('fonts/fonts.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('css/normalize.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" type="text/css">

        <link rel="stylesheet" href="{{ URL::asset('css/jquery.maximage.css') }}" type="text/css" media="screen" charset="utf-8" />
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        
       <script src="{{ URL::asset('js/jquery-latest.min.js') }}" type="text/javascript"></script>
       <script src="{{ URL::asset('js/main.js') }}" type="text/javascript"></script>

    </head>
    <body class="{{$pagetype}}">
            @include('includes.header')
            
            @yield('content')
            
            @include('includes.footer')
    </body>
</html>