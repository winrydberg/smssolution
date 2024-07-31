@extends("app.includes.dashboard_master")

@section("page_styles")
<link href="{{asset('assets/css/student_dashboard.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/jquery-steps.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
<style>

</style>
@stop

@section("content")
<div class="row">
    <div class="col-lg-12">	
        <h2 class="st_title"><i class="uil uil-file-alt"></i> Dashboard</h2>
    </div>					
</div>				
<div class="row" id="vue-section">					
    <div class="col-lg-12 col-md-12">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>REGISTER NEW STUDENT</h2>
            </div>
            <div class="statement_content">
				<input class="prompt srch_explore form-control" style="display:none;" type="text" value="{{Session::token()}}"  name="title" id="token" >	
				<!-- SmartWizard html -->
					<div id="smartwizard">
						<ul class="nav">
							<li class="nav-item">
							<a class="nav-link" href="#step-1">
								<div class="num">1</div>
								Student Info
							</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" href="#step-2">
								<span class="num">2</span>
								Guardian Info
							</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" href="#step-3">
								<span class="num">3</span>
								Admission Fee
							</a>
							</li>
							
						</ul>
					
						<div class="tab-content">
							<div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
								<div class="tab-from-content">
									<div class="title-icon">
										<h3 class="title"><i class="uil uil-info-circle"></i>Basic Information</h3>
									</div>
									<div class="course__form">
										<form id="form-1">
											<div class="general_info10">
												<div class="row">
													<div class="col-lg-12 col-md-12">	
														<div class="row">
															<div class="col-md-4">
																<div class="ui search focus mt-30 lbel25">
																	<label>Admission NO <span style="color:red">*</span></label>
																	<div class="ui left icon input swdh19">
																		<input class="form-control" value="{{$admission_no}}" type="text" disabled  name="title" id="admission_no">															
																	</div>
																</div>	
															</div>
														</div>														
														<div class="row">
															<div class="col-md-4">
																<div class="ui search focus mt-30 lbel25">
																	<label>First Name <span style="color:red">*</span></label>
																	<div class="ui input swdh19">
																		<input class="prompt srch_explore form-control required"  type="text" v-model="student.first_name"  name="first_name" >													
																	</div>
																</div>	
															</div>
															<div class="col-md-4">
																<div class="ui search focus mt-30 lbel25">
																	<label>Middle Name</label>
																	<div class="ui left icon input swdh19">
																		<input class="prompt srch_explore form-control" type="text" v-model="student.middle_name"  name="middle"  >															
																	</div>
																</div>	
															</div>
															<div class="col-md-4">
																<div class="ui search focus mt-30 lbel25">
																	<label>Surname <span style="color:red">*</span></label>
																	<div class="ui left icon input swdh19">
																		<input class="prompt srch_explore form-control required"  type="text" v-model="student.last_name" name="surname"  >															
																	</div>
																</div>	
															</div>
														</div>								
													</div>

													<div class="col-lg-4 col-md-4">
														<div class="mt-30 lbel25">
															<label>Gender <span style="color:red">*</span></label>
														</div>
														<select class="selectpicker required form-control" v-model="student.gender" name="gender">
															<option value="" disabled selected>Select an option</option>
															<option value="MALE">Male</option>
															<option value="FEMALE">Female</option>
														</select>
													</div>
													
													
													<div class="col-lg-4 col-md-4">
														<div class="mt-30 lbel25">
															<label>Class <span style="color:red">*</span></label>
														</div>
														<select class="selectpicker required form-control" v-model="student.class" name="class">
															<option value="" disabled selected>Select an option</option>
															@foreach($classes as $c)
																<option value="{{$c->id}}">{{$c->name}}</option>
															@endforeach
														</select>
													</div>

													<div class="col-lg-4 col-md-4">
														<div class="mt-30 lbel25">
															<label>Sub Category <span style="color:red">*</span></label>
														</div>
														<select class="selectpicker required form-control" v-model="student.subclass" name="sub_category">
															<option value="" disabled selected>Select an option</option>
															@foreach($sub_classes as $c)
																<option value="{{$c->id}}">{{$c->name}}</option>
															@endforeach
														</select>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="ui search focus mt-30 lbel25">
																<label>Photo</label>
																<div class="ui left icon input swdh19">
																	<input class="prompt srch_explore form-control" accept="image/*" type="file" @change="setSelectedImage"  name="photo">															
																</div>
															</div>	
														</div>
														<div class="col-md-6 mt-5">
															<img v-if="image == null" style="height: 150px; width: 150px; " src="{{asset('assets/images/hd_dp.jpg')}}" />
															<img v-else="image" style="height: 150px; width: 150px; " :src="student.image_src" />
														</div>
													</div>
																											
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
								<div class="tab-from-content">
									<div class="title-icon">
										<h3 class="title"><i class="uil uil-notebooks"></i>Parental Information</h3>
									</div>
									<div class="curriculum-section">
										<form id="form-2" >
											<div class="row mb-4">
												<div class="col-lg-12 col-md-12">															
													<div class="row">
														<div class="col-md-6">
															<div class="row">
																<p>NB: If parent / guardian already exists? Please select it instead of entry a new record.</p>
															</div>
															<div class="row">
																<div class="col-lg-12 col-md-12">
																	<div class="mt-30 lbel25">
																		<label>Select Parent <span style="color:red">*</span></label>
																	</div>
																	<select class="selectpicker" @change="getGuardian" id="guardian" v-model="student.guardian">
																		<option value="NEW">New Parent / Guardian</option>
																		@foreach($guardians as $g)
																			<option value="{{$g->id}}">{{$g->first_name.' '.$g->last_name}}</option>
																		@endforeach
																	</select>
																</div>
															</div>
														</div>
														<div class="col-md-6 mb-30" style="border-left: 1px solid gray;">
															<div class="col-md-12">
																<div class="ui search focus mt-30 lbel25">
																	<label>Parent / Guardian First Name <span style="color:red">*</span></label>
																	<div class="ui left icon input swdh19">
																		<input class="prompt srch_explore form-control required" type="text"  name="guard_first_name"  v-model="student.guardian_firstname">															
																	</div>
																</div>	
															</div>
															<div class="col-md-12">
																<div class="ui search focus mt-30 lbel25">
																	<label>Parent / Guardian Surname <span style="color:red">*</span></label>
																	<div class="ui left icon input swdh19">
																		<input class="prompt srch_explore form-control required" type="text"  name="guard_last_name" v-model="student.guardian_lastname" >															
																	</div>
																</div>	
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="ui search focus mt-30 lbel25">
																		<label>Parent / Guardian Email</label>
																		<div class="ui left icon input swdh19">
																			<input class="prompt srch_explore form-control" type="text"  name="guard_email"  v-model="student.guardian_email" >															
																		</div>
																	</div>	
																</div>
																<div class="col-md-6">
																	<div class="ui search focus mt-30 lbel25">
																		<label>Parent / Guardian Phone No <span style="color:red">*</span></label>
																		<div class="ui left icon input swdh19">
																			<input class="prompt srch_explore form-control " type="text"  name="guard_phone"  v-model="student.guardian_phone" >															
																		</div>
																	</div>	
																</div>
															</div>

															<div class="col-md-12">
																<div class="ui search focus mt-30 lbel25">
																	<label>Parent / Guardian House No <span style="color:red">*</span></label>
																	<div class="ui left icon input swdh19">
																		<input class="prompt srch_explore form-control required" type="text"  name="guard_house_no"  v-model="student.guardian_houseno" >															
																	</div>
																</div>	
															</div>

															<div class="col-md-12">
																<div class="ui search focus mt-30 lbel25">
																	<label>Parent / Guardian Occupation <span style="color:red">*</span></label>
																	<div class="ui left icon input swdh19">
																		<input class="prompt srch_explore form-control required" type="text"  name="guard_occupation"  v-model="student.guardian_occupation" >															
																	</div>
																</div>	
															</div>


														</div>
													</div>								
												</div>
												
																										
											</div>
										</form>
									</div>
								</div>
							</div>
							<div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
								<div class="tab-from-content">
									<div class="title-icon">
										<h3 class="title"><i class="uil uil-image"></i>Fees</h3>
									</div>
									<div class="row">
										<form id="form-3" @submit.prevent="registerStudent" class="mb-50">
										{{-- <div class="col-md-12"> --}}
											<div class="col-md-6">
												<div class="ui search focus mt-30 lbel25">
													<label>Admission Fee(GHC) </label>
													<div class="ui left icon input swdh19">
														<input class="prompt srch_explore form-control required" type="number"  name="title"  v-model="student.admission_fee" >															
													</div>
												</div>	
											</div>
											<div class="col-lg-6 col-md-6">
												<div class="mt-30 lbel25">
													<label>Payment Status <span style="color:red">*</span></label>
												</div>
												<select class="selectpicker" v-model="student.admission_fee_status">
													<option value="PAID" >Paid</option>
													{{-- <option value="NOTPAID" >Not Paid</option> --}}
												</select>
												<small style="color:brown;">Selecting <strong>Not Paid</strong> will raise an invoice for student to pay later in the future</small>
											</div>
											<div class="col-md-6" v-show="student.admission_fee_status == 'PAID'">
												<div class="ui search focus mt-30 lbel25">
													<label>Payment Receipt </label>
													<div class="ui left icon input swdh19">
														<input class="prompt srch_explore form-control" type="file"  name="title"  >															
													</div>
												</div>	
											</div>
										{{-- </div> --}}
											<div class="col-md-6">
												<button class="add_crdit_btn mt-30" type="submit"><i class="uil uil-plus"></i> Register Student</button>
											</div>
										</form>

										
									</div>
								</div>
							</div>
							{{-- <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
								Step content
							</div> --}}
						</div>
					
						<!-- Include optional progressbar HTML -->
						<div class="progress">
						<div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>  

				</div>
            </div>
        </div>			
    </div>
</div>




@stop

@section("scripts")
<script src="{{asset('assets/vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/js/jquery-steps.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
<script src="{{asset('assets/vue/new_student.js')}}"></script>

@stop