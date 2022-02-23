<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
<!-- Font -->


 <!-----NEW STYEL---->
 <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Stylesheets -->

<link href="{{asset('asset/frontend/css/common-css/bootstrap.css')}}" rel="stylesheet">

<link href="{{asset('asset/frontend/css/common-css/swiper.css')}}" rel="stylesheet">

<link href="{{asset('asset/frontend/css/ionicons.css')}}" rel="stylesheet">


<link href="{{asset('asset/frontend/css/front-page-category/css/styles.css')}}" rel="stylesheet" />

<link href="{{asset('asset/frontend/css/front-page-category/css/responsive.css')}}" rel="stylesheet" />
<style>
        .favorite_posts{
            color: red!important;
        }
		ion-icon {
          font-size: 25px;
		  margin:3px;
        }

		li{
			font-weight: 700;
		}

		
    </style>
@stack('css')
   
</head>
<body>

@include('layouts.frontend.include.header')

 @yield('content')

@include('layouts.frontend.include.footer')
	



<script src="{{ asset('asset/frontend/js/scripts.js') }}"></script>


<!-------NEW JS----------->

<script src="{{asset('asset/frontend/js/common-js/jquery-3.1.1.min.js')}}"></script>

<script src="{{asset('asset/frontend/js/common-js/tether.min.js')}}"></script>

<script src="{{asset('asset/frontend/js/common-js/bootstrap.js')}}"></script>

<script src="{{asset('asset/frontend/js/common-js/swiper.js')}}"></script>

<script src="{{asset('asset/frontend/js/common-js/scripts.js')}}"></script>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}','Error',{
        closeButton:true,
        progressBar:true,
    });
    @endforeach
    @endif
</script>
@stack('js')
</body>
</html>
