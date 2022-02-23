<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

       <link href="{{asset('asset/frontend/css/common-css/bootstrap.css')}}" rel="stylesheet">

        <link href="{{asset('asset/frontend/css/common-css/swiper.css')}}" rel="stylesheet">

        <link href="{{asset('asset/frontend/css/common-css/ionicons.css')}}" rel="stylesheet">


        <link href="{{asset('asset/frontend/css/front-page-category/css/styles.css')}}" rel="stylesheet">

        <link href="{{asset('asset/frontend/css/front-page-category/css/responsive.css')}}" rel="stylesheet">

        <link href="{{asset('frontend/css/styles.css')}}" rel="stylesheet">

	<link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>


@include('layouts.frontend.include.header')

 @yield('contents')

@include('layouts.frontend.include.footer')
	


	<!-- SCIPTS -->

	<script src="{{asset('asset/frontend/js/ommon-js/jquery-3.1.1.min.js')}}"></script>

	<script src="{{asset('asset/frontend/js/ommon-js/tether.min.js')}}"></script>

	<script src="{{asset('asset/frontend/js/common-js/bootstrap.js')}}"></script>

	<script src="{{asset('asset/frontend/js/common-js/swiper.js')}}"></script>

	<script src="{{asset('asset/frontend/js/common-js/scripts.js')}}"></script>
</body>
</html>
