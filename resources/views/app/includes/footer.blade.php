	@yield("page_scripts")
	{{-- <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script> --}}
	<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('assets/vendor/OwlCarousel/owl.carousel.js')}}"></script>
	<script src="{{asset('assets/vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js')}}"></script>
	<script src="{{asset('assets/vendor/semantic/semantic.min.js')}}"></script>
	{{-- <script src="js/custom.js"></script>	 --}}
	{{-- <script src="js/night-mode.js"></script> --}}

	<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
	<script>
		Vue.config.delimiters = ['[[', ']]'];
	</script>
	@yield("scripts")
	
</body>
</html>


