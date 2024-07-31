	<!-- Left Sidebar Start -->
	<nav class="vertical_nav">
		<div class="left_section menu_left" id="js-menu" >
			<div class="left_section">
				<ul>
					<li class="menu--item">
						<a href="{{url('/dashboard')}}" class="menu--link active" title="Home">
							<i class='uil uil-home-alt menu--icon'></i>
							<span class="menu--label">Home</span>
						</a>
					</li>

					{{-- <li class="menu--item">
						<a href="{{url('/explore')}}" class="menu--link" title="Explore">
							<i class='uil uil-search menu--icon'></i>
							<span class="menu--label">Explore</span>
						</a>
					</li> --}}
                    <li class="menu--item menu--item__has_sub_menu">
						<label class="menu--link" title="Classes">
							<i class='uil uil-layers menu--icon'></i>
							<span class="menu--label">Setup</span>
						</label>
						<ul class="sub_menu">
							<li class="sub_menu--item">
								<a href="{{url('/classes')}}" class="sub_menu--link">Classes</a>
							</li>
							<li class="sub_menu--item">
								<a href="{{url('/subjects')}}" class="sub_menu--link">Subjects</a>
							</li>
							<li class="sub_menu--item">
								<a href="{{url('/terms')}}" class="sub_menu--link">Academic Year & Terms</a>
							</li>
							<li class="sub_menu--item">
								<a href="{{url("fees")}}" class="sub_menu--link">Fees</a>
							</li>
						</ul>
					</li>
					<li class="menu--item menu--item__has_sub_menu">
						<label class="menu--link" title="Categories">
							<i class='uil uil-book-alt menu--icon'></i>
							<span class="menu--label">Students</span>
						</label>
						<ul class="sub_menu">
							<li class="sub_menu--item">
								<a href="{{url('/new-student')}}" class="sub_menu--link">New Student</a>
							</li>
							<li class="sub_menu--item">
								<a href="{{url('/students')}}" class="sub_menu--link">Find Student(s)</a>
							</li>
						</ul>
					</li>
					<li class="menu--item  menu--item__has_sub_menu">
						<label class="menu--link" title="Tests">
						  <i class='uil uil-star menu--icon'></i>
						  <span class="menu--label">Staff / Teachers</span>
						</label>
						<ul class="sub_menu">
							<li class="sub_menu--item">
								<a href="{{url('/new-staff')}}" class="sub_menu--link">New Staff</a>
							</li>
                            <li class="sub_menu--item">
								<a href="{{url("/staff-types")}}" class="sub_menu--link">Staff Types</a>
							</li>
							<li class="sub_menu--item">
								<a href="{{url('/staff-list')}}" class="sub_menu--link">All Staffs</a>
							</li>
						</ul>
					</li>
					
					{{-- <li class="menu--item  menu--item__has_sub_menu">
						<label class="menu--link" title="Pages">
						  <i class='uil uil-file menu--icon'></i>
						  <span class="menu--label">Fees</span>
						</label>
						<ul class="sub_menu">
							<li class="sub_menu--item">
								<a href="{{url("fees")}}" class="sub_menu--link">Fees</a>
							</li>
						</ul>
					</li> --}}

					<li class="menu--item  menu--item__has_sub_menu">
						<label class="menu--link" title="Pages">
						  <i class='uil uil-wallet menu--icon'></i>
						  <span class="menu--label">Payments & Invoices</span>
						</label>
						<ul class="sub_menu">
							<li class="sub_menu--item">
								<a href="{{url("accept-payment")}}" class="sub_menu--link">Accept Payment</a>
							</li>
							<li class="sub_menu--item">
								<a href="{{url("unpaid-invoices")}}" class="sub_menu--link">Pending Payments</a>
							</li>
							<li class="sub_menu--item">
								<a href="{{url('payments')}}" class="sub_menu--link">All Payments</a>
							</li>
							
						</ul>
					</li>

					<li class="menu--item  menu--item__has_sub_menu">
						<label class="menu--link" title="Expenditure">
						  <i class='uil uil-dollar-sign menu--icon'></i>
						  <span class="menu--label">Expenditure</span>
						</label>
						<ul class="sub_menu">
							<li class="sub_menu--item">
								<a href="{{url("expenditure-categories")}}" class="sub_menu--link">Expenditure Categories</a>
							</li>
							<li class="sub_menu--item">
								<a href="{{url("new-expenditure")}}" class="sub_menu--link">New Expenditure</a>
							</li>
							{{-- <li class="sub_menu--item">
								<a href="{{url("expenditure-history")}}" class="sub_menu--link">Expenditure History</a>
							</li>	 --}}
						</ul>
					</li>

					<li class="menu--item  menu--item__has_sub_menu">
						<label class="menu--link" title="Expenditure">
						  <i class='uil uil-folder menu--icon'></i>
						  <span class="menu--label">Academic Records</span>
						</label>
						<ul class="sub_menu">
							<li class="sub_menu--item">
								<a href="{{url("record-types")}}" class="sub_menu--link">Record Types</a>
							</li>
							<li class="sub_menu--item">
								<a href="{{url("records-entry")}}" class="sub_menu--link">Records Entry</a>
							</li>
							<li class="sub_menu--item">
								<a href="{{url("my-classes")}}" class="sub_menu--link">My Classes</a>
							</li>
						</ul>
					</li>

					<li class="menu--item  menu--item__has_sub_menu">
						<label class="menu--link" title="Reports">
						  <i class='uil uil-file-alt menu--icon'></i>
						  <span class="menu--label">Reports</span>
						</label>
						<ul class="sub_menu">
							<li class="sub_menu--item">
								<a href="{{url("revenue-reports")}}" class="sub_menu--link">Revenue Reports</a>
							</li>
							<li class="sub_menu--item">
								<a href="{{url("expenditure-reports")}}" class="sub_menu--link">Expenditure Reports</a>
							</li>	
						</ul>
					</li>

					<li class="menu--item  menu--item__has_sub_menu">
						<label class="menu--link" title="Notifications">
						  <i class='uil uil-bell menu--icon'></i>
						  <span class="menu--label">Notifications</span>
						</label>
						<ul class="sub_menu">
							<li class="sub_menu--item">
								<a href="{{url("sms")}}" class="sub_menu--link">SMS</a>
							</li>
							<li class="sub_menu--item">
								<a href="{{url("email")}}" class="sub_menu--link">Email</a>
							</li>
						</ul>
					</li>

				</ul>
			</div>

			<div class="left_section pt-2">
				<ul>
					<li class="menu--item">
						<a href="{{url('/settings')}}" class="menu--link" title="Setting">
							<i class='uil uil-cog menu--icon'></i>
							<span class="menu--label">Setting</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="help.html" class="menu--link" title="Help">
							<i class='uil uil-question-circle menu--icon'></i>
							<span class="menu--label">Help</span>
						</a>
					</li>
					<li class="menu--item">
						<a href="{{url("/logout")}}" class="menu--link" title="Report History">
							<i class='uil uil-sign-out-alt menu--icon'></i>
							<span class="menu--label">Logout</span>
						</a>
					</li>
				</ul>
			</div>
			{{-- <div class="left_footer">
				<ul>
					<li><a href="about_us.html">About</a></li>
					<li><a href="press.html">Press</a></li>
					<li><a href="contact_us.html">Contact Us</a></li>
					<li><a href="coming_soon.html">Advertise</a></li>
					<li><a href="coming_soon.html">Developers</a></li>
					<li><a href="terms_of_use.html">Copyright</a></li>
					<li><a href="terms_of_use.html">Privacy Policy</a></li>
					<li><a href="terms_of_use.html">Terms</a></li>
				</ul>
				<div class="left_footer_content">
					<p>© 2024 <strong>Cursus</strong>. All Rights Reserved.</p>
				</div>
			</div> --}}
		</div>
	</nav>
	<!-- Left Sidebar End -->