@extends("app.includes.master")

@section("page_styles")
<link href="{{asset('assets/css/vertical-responsive-menu1.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/instructor-dashboard.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/instructor-responsive.css')}}" rel="stylesheet">
@stop

@section("component")
    <x-header-component></x-header-component>

    <x-sidebar-component></x-sidebar-component>
    	<!-- Body Start -->
	<div class="wrapper">
		<div class="sa4d25">
			<div class="container-fluid">			
				   
                @yield("content")

			</div>
		</div>
        <x-footer-component></x-footer-component>
	</div>
	<!-- Body End -->
@stop

@section("page_scripts")
<script src="{{asset('assets/js/vertical-responsive-menu.min.js')}}"></script>
@stop