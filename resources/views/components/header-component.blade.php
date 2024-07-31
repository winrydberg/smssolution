	<!-- Header Start -->
	<header class="header clearfix">
		<button type="button" id="toggleMenu" class="toggle_menu">
		  <i class='uil uil-bars'></i>
		</button>
		<button id="collapse_menu" class="collapse_menu">
			<i class="uil uil-bars collapse_menu--icon "></i>
			<span class="collapse_menu--label"></span>
		</button>
		<div class="main_logo" id="logo">
			<a href="index.html"><img src="images/logo.svg" alt=""></a>
			<a href="index.html"><img class="logo-inverse" src="images/ct_logo.svg" alt=""></a>
		</div>
		<div class="search120">
			<div class="ui search">
				Academic Year: <span class="mini ui blue button " style="font-size: 10px;">{{$academic_year != null ? $academic_year : 'N/A'}}</span> 
				<span style="margin-left: 100px">Term: <span class="mini ui brown button" style="font-size: 10px; text-transform:uppercase;">{{$term != null ? $term->name : 'N/A'}}</span></span>
			</div>
		</div>
		<div class="header_right">
			<ul>
				@if(!request()->is('dashboard'))
					<li>
						<a href="{{url('/new-student')}}" class="upload_btn ui violet button" title="Create New Course"><i class="fa fa-user-plus"></i> Register Student</a>
					</li>
				@endif
			
				<li class="dropdown-noti">
					<a href="#" class="option_links" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false"><i class='uil uil-bell'></i><span class="noti_count">3</span></a>
					<div class="dropdown-menu dropdown_mn drop-down">
						<a href="#" class="channel_my item">
							<div class="profile_link">
								{{-- <img src="images/left-imgs/img-1.jpg" alt=""> --}}
								<div class="pd_content">
									<h6>Rock William</h6>
									<p>Like Your Comment On Video <strong>How to create sidebar menu</strong>.</p>
									<span class="nm_time">2 min ago</span>
								</div>							
							</div>							
						</a>
						<a href="#" class="channel_my item">
							<div class="profile_link">
								<img src="images/left-imgs/img-2.jpg" alt="">
								<div class="pd_content">
									<h6>Jassica Smith</h6>
									<p>Added New Review In Video <strong>Full Stack PHP Developer</strong>.</p>
									<span class="nm_time">12 min ago</span>
								</div>							
							</div>							
						</a>
						<a href="#" class="channel_my item">
							<div class="profile_link">
								<img src="images/left-imgs/img-9.jpg" alt="">
								<div class="pd_content">
									<p> Your Membership Approved <strong>Upload Video</strong>.</p>
									<span class="nm_time">20 min ago</span>
								</div>							
							</div>							
						</a>
						<a class="vbm_btn" href="instructor_notifications.html">View All <i class='uil uil-arrow-right'></i></a>
					</div>
				</li>
                @if(Auth::check())
				<li class="profile-dropdown">
					<a href="#" class="opts_account" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
						<img src="{{asset('assets/images/hd_dp.jpg')}}" alt="">
					</a>
					<div class="dropdown-menu dropdown_account drop-down dropdown-menu-end">
						<div class="channel_my">
							<div class="profile_link">
								<img src="{{asset('assets/images/hd_dp.jpg')}}" alt="">
								<div class="pd_content">
									<div class="rhte85">
                                        <?php 
                                            $user = Auth::user();  
                                        ?>
										<h6>{{$user->first_name." ".$user->last_name}}</h6>
										<div class="mef78" title="Verify">
											<i class='uil uil-check-circle'></i>
										</div>
									</div>
									<span>{{$user->email}}</span>
								</div>							
							</div>
							
						</div>
						
						<a href="{{url('/profile')}}" class="item channel_item">Profile</a>						
						<a href="{{url('/settings')}}" class="item channel_item">Setting</a>
						<a href="{{url('/help')}}" class="item channel_item">Help</a>
						<a href="{{url('/logout')}}" class="item channel_item">Sign Out</a>
					</div>
				</li>
                @endif
			</ul>
		</div>
	</header>
	<!-- Header End -->