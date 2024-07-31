@extends("app.includes.dashboard_master")

@section("page_styles")
<link href="{{asset('assets/css/student_dashboard.css')}}" rel="stylesheet">
@stop

@section("content")
    <div class="row">
        <div class="col-lg-12">	
            <h2 class="st_title"><i class="uil uil-file-alt"></i> Dashboard</h2>
        </div>					
    </div>				
    <div class="row" id="vue-section">	
        <div class="col-lg-6 col-md-6">
            <div class="top_countries mt-30">
                <div class="top_countries_title">
                    <h2>TERMS</h2>
                </div>
                <div class="statement_content">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($terms as $key => $t)
                                    <tr>
                                        <td>{{$key +1}}</td>
                                        <td>{{$t->name}}</td>
                                        <td>
                                            @if($t->active)
                                                <span class="mini ui green tag label">Active</span>
                                                {{-- <span class="user-status-tag online" style="background-color: #40d04f; padding:5px 12px; color:white"> Active</span> --}}
                                            @else
                                                <span class="mini ui red tag label">Not Active</span>
                                                {{-- <span class="user-status-tag offline" style="background-color: #c22e09; padding:5px 12px; color:white"> </span> --}}
                                            @endif
                                        </td>
                                        <td>
                                            <button class="mini ui orange button" @click="activateTerm('{{$t->id}}')"><i class="uil uil-message"></i> Activate</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>			
        </div>



        <div class="col-lg-6 col-md-6">
            <div class="top_countries mt-30">
                <div class="top_countries_title">
                    <h2>ACADEMIC YEARS</h2>
                </div>
                <div class="statement_content">
                    <button class="ui brown button mb-2" @click="openModal()"><i class="fa fa-plus-circle"></i> Academic Year</button>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($academic_years as $key => $t)
                                    <tr>
                                        <td>{{$key +1}}</td>
                                        <td>{{$t->name}}</td>
                                        <td>
                                            @if($t->active)
                                                <span class="mini ui green tag label">Active</span>
                                                {{-- <span class="user-status-tag online" style="background-color: #40d04f; padding:5px 12px; color:white"> Active</span> --}}
                                            @else
                                                <span class="mini ui red tag label">Not Active</span>
                                                {{-- <span class="user-status-tag offline" style="background-color: #c22e09; padding:5px 12px; color:white"> </span> --}}
                                            @endif
                                        </td>
                                        <td>
                                            <button class="mini ui orange button" @click="activateAcademicYear('{{$t->id}}')"><i class="uil uil-message"></i> Activate</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>			
        </div>

        <div class="modal fade" id="acaModal" tabindex="-1" role="dialog" aria-labelledby="classModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="classModalLabel">New Academic Year</h5>
                  <button type="button" @click="closeModal()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="new_academic_year_form" @submit.prevent="setNewAcademicYear">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="ui search focus mt-30 lbel25">
                                <label>Year One <span style="color:red;">*</span></label>
                                <div class="ui left icon input swdh19">	
                                   <select class="form-control" required v-model="form.year_one">
                                        <option value="0">Select an option</option>
                                        @foreach($years as $year)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>	
                        <div class="col-lg-6 col-md-6">
                            <div class="ui search focus mt-30 lbel25">
                                <label>Year Two <span style="color:red;">*</span></label>
                                <div class="ui left icon input swdh19" required>	
                                   <select class="form-control" required v-model="form.year_two">
                                        <option value="0">Select an option</option>
                                        @foreach($years as $year)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>	
                        
                    </div>
                    <button type="submit" class="add_crdit_btn mt-4">Save Academic Year</button>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" @click="closeModal()" data-dismiss="modal">Close</button>
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
    <script src="{{asset('assets/vue/term.js')}}"></script>
@stop