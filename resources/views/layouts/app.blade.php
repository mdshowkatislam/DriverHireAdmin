<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fabicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/log_icon/carlogo-removebg.png')}}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('assets/plugins/css/bootstrap.min.css')}}" />

    <link rel="stylesheet" href="{{ asset('assets/plugins/css/swiper-bundle.min.css')}}" />

    <link rel="stylesheet" href="{{ asset('assets/plugins/css/modal-video.min.css')}}" />

    <link rel="stylesheet" href="{{ asset('assets/plugins/css/magnific-popup.css')}}" />

    <link rel="stylesheet" href="{{ asset('assets/plugins/css/nice-select.css')}}" />

    <link rel="stylesheet" href="{{ asset('assets/plugins/css/select2.min.css')}}" />

    <link rel="stylesheet" href="{{ asset('assets/plugins/css/summernote-lite.min.css')}}" />

    <link rel="stylesheet" href="{{ asset('assets/plugins/css/rangeslider.css')}}" />

    <link rel="stylesheet" href="{{ asset('assets/sass/style.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/switch/bootstrap-switch.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    @stack('subcss')
</head>

<body>
    <div class="scrolltop" onclick="scrollUp();">
        <i class="fas fa-chevron-up"></i>
    </div>

    @include('layouts.header')
    @include('layouts.sidebar')

    <main class="main_content_area">
        @yield('content')
    </main>

    <!-- JS Here -->
    <script src="{{ asset('assets/plugins/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/js/swiper-bundle.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
    <script src="{{ asset('assets/plugins/js/jquery.rcounter.js')}}"></script>
    <script src="{{ asset('assets/plugins/js/jquery-modal-video.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('assets/plugins/js/select2.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/js/summernote-lite.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/js/rangeslider.min.js')}}"></script>
    <script src="{{ asset('assets/switch/bootstrap-switch.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/46f35fbc02.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/helper.js') }}"></script>
    <script src="{{ asset('assets/toastr/toastr.js') }}"></script>
    {!! Toastr::message() !!}

    <script>
        // Data Picker Initialization
        $('.datepicker').datepicker({
            altFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
        });
    </script>

    @stack('subjs')
</body>

</html>