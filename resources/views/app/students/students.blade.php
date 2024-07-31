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
<span id="vue-section">			
<div class="row">					
    <div class="col-lg-12 col-md-12">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>FILTER STUDENTS</h2>
            </div>
            <div class="statement_content">
                <form method="GET">
                    {{csrf_field()}}
                    <input style="display: none;" class="prompt srch_explore form-control" value="1" type="text" name="search">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="ui search focus mt-2 lbel25">
                                <label>Admission NO </label>
                                <div class="ui left icon input swdh19">	
                                    <input class="prompt srch_explore form-control" value="{{request()->get("admissionno")}}" type="text" name="admissionno">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4">
                            <div class="ui search focus mt-2 lbel25">
                                <label>Student Name </label>
                                <div class="ui left icon input swdh19">	
                                    <input class="prompt srch_explore form-control" value="{{request()->get("name")}}" type="text" name="name">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="ui search focus mt-2 lbel25">
                                <label>Class </label>
                                <div class="ui left icon input swdh19">	
                                    <select class="prompt srch_explore form-control" name="class">
                                        <option value="">Select an option</option>
                                        @foreach($classes as $class)
                                            <option {{request()->get("class") == $class->id ? 'selected' : '' }} value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="ui search focus mt-30 lbel25">
                                <button type="submit" class="ui violet  button block">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>			
    </div>
</div>
<div class="row" >					
    <div class="col-lg-12 col-md-12">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>STUDENTS</h2>
            </div>
            <div class="statement_content">
               <div class="table-responsive">
                <table class="table table-striped text-nowrap" id="students">
                    <thead>
                        <th>#ID</th>
                        <th>PHOTO</th>
                        <th>ADMISSION NO</th>
                        <th>STUDENT ID</th>
                        <th>FULL NAME</th>
                        <th>CLASS</th>
                        <th>SUB CLASS</th>
                        <th>GUARDIAN NAME</th>
                        <th>GUARDIAN PHONE</th>
                        <th>ACTION</th>
                    </thead>

                    <tbody>
                        @foreach($students as $key => $t)
                            <tr>
                                <td>{{$key +1 }}</td>
                                <td>
                                    @if($t->photo != null)
                                        <img src="{{$t->photo}}" style="height: 40px; width: 40px; border-radius: 25px;" class="img-fluid" />
                                    @else
                                        <img src="{{asset('assets/images/hd_dp.jpg')}}" style="height: 40px; width: 40px; border-radius: 25px;" class="img-fluid" />
                                    @endif
                                </td>
                                <td>{{$t->admission_no}}</td>
                                <td>{{$t->student_id}}</td>
                                <td>{{$t->first_name." ".$t->last_name}}</td>
                                <td>{{$t->sclass?->name}}</td>
                                <td>{{$t->sub_class?->name}}</td>
                                <td>{{$t->guardian?->first_name.' '.$t->guardian?->last_name}}</td>
                                <td>{{$t->guardian?->phone}}</td>
                                <td>
                                    <a href="{{url("/student-details?sid=".$t->id)}}" class="mini ui purple button"> <i class="uil uil-eye"></i> Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               </div>
            </div>
        </div>			
    </div>
</div>
</span>
@stop

@section("scripts")
<script src="{{asset('assets/vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
@include("app.includes.datatable_scripts")
<script src="{{asset('assets/vue/students.js')}}"></script>


@stop