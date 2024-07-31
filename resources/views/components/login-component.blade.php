	<!-- Signup Start -->
	<div class="sign_in_up_bg" id="vue-section">
		<div class="container">
			<div class="row justify-content-lg-center justify-content-md-center">
				<div class="col-lg-12">
					<div class="main_logo25" id="logo">
						<a href="{{url("/")}}"><img src="{{asset('assets/images/sign_logo.png')}}" alt=""></a>
						{{-- <a href="index.html"><img class="logo-inverse" src="images/ct_logo.svg" alt=""></a> --}}
					</div>
				</div>
			
				<div class="col-lg-6 col-md-8">
					<div class="sign_form">
						<h2>Welcome Back</h2>
						<p>Log In to Proceed</p>
                        <p v-show="has_error" class="alert alert-danger">[[error_message]]</p>
					    <form id="loginForm" @submit.prevent="submitForm">
                            {{csrf_field()}}
							<div class="ui search focus mt-15">
								<div class="ui left icon input swdh95">
									<input class="prompt srch_explore form-control" type="email" name="email" v-model="form.email" id="email" required="" placeholder="Enter Email Address">															
									<i class="uil uil-user icon icon2"></i>
								</div>
							</div>
							<div class="ui search focus mt-15">
								<div class="ui left icon input swdh95">
									<input class="prompt srch_explore form-control" type="password" name="password" v-model="form.password"  id="password" required=""  placeholder="Password">
									<i class="uil uil-key-skeleton-alt icon icon2"></i>
								</div>
							</div>
							<button class="login-btn" type="submit"><img class="img-fluid mx-2" id="loader" v-show="loading"  style="height: 20px; width: 20px;" src="{{asset('assets/gif/loading.gif')}}" />Sign In</button>
						</form>
						<p class="sgntrm145">Or <a href="forgot_password.html">Forgot Password</a>.</p>
					</div>
					<div class="sign_footer"><img src="{{asset('assets/images/sign_logo.png')}}" alt="">© {{date("Y")}} <strong>{{env("SCHOOL_NAME")}}</strong>. All Rights Reserved.</div>
				</div>				
			</div>				
		</div>				
	</div>
	<!-- Signup End -->	

    @section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '#vue-section',
            delimiters: ['[[', ']]'], // I have already set the global config for this
            data: {
                loading: false,
                has_error: false,
                error_message: "",
                form: {
                    email: "",
                    password: "",
                    _token: "{{Session::token()}}"
                },
            },
            methods: {
                submitForm(){
                    this.loading = true;
                    axios.post('/login', this.form)
                        .then(response => {
                            this.loading = false;
                            if(response.data.status == "success"){
                                window.location.href = response.data.dashboard
                            }else{
                                this.error_message = response.data.message;
                                this.has_error = true;
                                setTimeout(() => {
                                    this.has_error = false;
                                }, 2000);
                            }
                        })
                        .catch(error => {
                            this.loading = false;
                            this.error_message = error.message;
                            this.has_error = true;
                            setTimeout(() => {
                                this.has_error = false;
                            }, 2000);
                        });
                }
            }
        });
    </script>
    @stop

