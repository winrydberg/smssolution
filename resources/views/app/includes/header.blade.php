<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">
		<title>{{env("SCHOOL_NAME")}} - @yield('title', "Home")</title>

		<meta name="_token" content="{{ csrf_token() }}">
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="images/fav.png">
		
		<!-- Stylesheets -->
		{{-- <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'> --}}
		<link href='{{asset('assets/vendor/unicons-2.0.1/css/unicons.css')}}' rel='stylesheet'>
		<link href="{{asset('assets/css/vertical-responsive-menu.min.css')}}" rel="stylesheet">
		<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
		<link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet">
		
		@yield("page_styles")
		{{-- <link href="css/night-mode.css" rel="stylesheet"> --}}
		
		<!-- Vendor Stylesheets -->
		<link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
		<link href="{{asset('assets/vendor/OwlCarousel/assets/owl.carousel.css')}}" rel="stylesheet">
		<link href="{{asset('assets/vendor/OwlCarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
		<link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('assets/vendor/bootstrap-select/docs/docs/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/semantic/semantic.min.css')}}">	
		{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}


		<style>
			.ui.input {
				display: block;
				color: rgba(0, 0, 0, 0.87);
			}
			label.error{
				color: red;
			}
			.block {
				width: 100%;
			}
			.dt-button.buttons-excel.buttons-html5{
				background-color: #21ba45;
				color: #fff;
				text-shadow: none;
				background-image: none;
			}
			a {
				color:white;
			}
		</style>
		<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
	</head> 

<body>