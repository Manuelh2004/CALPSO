{{-- Plantilla tomada de https://designreset.com/cork/ltr/demo4/ --}}

@include('inc.function')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('titulo',"") | {{ENV("APP_NAME")}}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset(ENV('APP_FAVICON')) }}"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    @include('inc.styles')    
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    @yield('head')
</head>
<body >
    
    <!-- BEGIN LOADER -->
    <div id="preloader" class="preloader" style="background: #ffffff80">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">{{ENV("APP_NAME")}}</p>
        </div>
    </div>
    <!--  END LOADER -->

    @include('inc.navbar')
    
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('inc.sidebar')

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">

            @yield('content')

            @include('inc.footer')
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    @include('inc.scripts')
    
    @yield('script')
</body>
</html>
