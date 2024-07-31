@extends("app.includes.dashboard_master")

@section("page_styles")
    <link href="{{asset('assets/css/student_dashboard.css')}}" rel="stylesheet">
    @include("app.includes.datatable_css")
@stop

@section("content")
<div class="row">
    <div class="col-lg-12">	
        <h2 class="st_title"><i class="uil uil-file-alt"></i> Dashboard</h2>
    </div>					
</div>				
<div class="row" id="vue-section">					
    <div class="col-lg-8 col-md-8">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>ALL SUBJECTS</h2>
            </div>
            <div class="statement_content">
               <div class="table-responsive">
                    <table class="table table-striped text-nowrap" id="subjects">
                        <thead>
                            <th style="width: 5px;">#ID</th>
                            <th>NAME</th>
                            <th>ACTIONS</th>
                        </thead>
                        <tbody>
                            @foreach($subjects as $key => $c)
                                <tr>
                                    <td>{{$key +1}}</td>
                                    <td>{{$c->name}}</td>
                                    <td>
                                        {{-- <button class="btn"><i class="uil uil-eye"></i> Details</button> --}}
                                        <button class="small ui orange button" @click="deleteSubject('{{$c->id}}')"><i class="uil uil-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>
            </div>
        </div>			
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>NEW SUBJECT</h2>
            </div>
            <div class="statement_content">
                <p><i class="uil uil-info-circle" style="color:red;"></i> Complete below for to add subjects into the system</p>
               <form @submit.prevent="createNewSubject" id="newClassForm">
                    <div class="col-md-12">
                        <div class="ui search focus mt-20 lbel25">
                            <label>Subject Name <span style="color:red;">*</span></label>
                            <div class="ui left icon input swdh19">	
                                <input v-model="form.subject_name" required class="prompt srch_explore form-control" type="text" name="subject_name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="add_crdit_btn mt-30" type="submit"><i class="uil uil-plus"></i> Add Subject</button>
                    </div>
               </form>
            </div>
        </div>
    </div>
</div>




@stop

@section("scripts")
<script src="{{asset('assets/vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include("app.includes.datatable_scripts")

<script src="{{asset("assets/vue/subjects.js")}}"></script>
@stop