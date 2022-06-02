<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Buy Smart">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name', 'Buy Smart')}} | @yield('page-title','Dashboard')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('front-end/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-end/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-end/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-end/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-end/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-end/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-end/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-end/css/style.css')}}" type="text/css">
    @stack('css')
</head>

<body>
    <!-- Page Preloder -->

    <!-- Header Section Begin -->
    @include('frontend.partials.header')
    <!-- Header Section End -->
    <!-- Header Section Begin -->
    @if(\URL::current() != 'http://127.0.0.1:8000')
        @include('frontend.partials.breadcrumb')
    @endif
    <!-- Header Section End -->
    @yield('content')

    <!-- Footer Section Begin -->
        @include('frontend.partials.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('front-end/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('front-end/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front-end/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front-end/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('front-end/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('front-end/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('front-end/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('front-end/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front-end/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('front-end/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>