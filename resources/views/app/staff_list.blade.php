@extends("app.includes.dashboard_master")

@section("page_styles")
<link href="{{asset('assets/css/student_dashboard.css')}}" rel="stylesheet">
@include("app.includes.datatable_css")
{{-- <link href="{{asset('assets/vendor/bootstrap-select/docs/docs/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"> --}}
@stop

@section("content")
<div class="row">
    <div class="col-lg-12">	
        <h2 class="st_title"><i class="uil uil-file-alt"></i> Dashboard</h2>
    </div>					
</div>				
<div class="row">					
    <div class="col-lg-12 col-md-12">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>STAFFS</h2>
            </div>
            <div class="statement_content">
               <div class="table-responsive">
                <table class="table table-striped" id="staffs">
                    <thead>
                        <th>#ID</th>
                        <th>PHOTO</th>
                        <th>STAFF NO</th>
                        <th>FULL NAME</th>
                        <th>PHONE</th>
                        <th>EMAIL</th>
                        <th>STAFF TYPE</th>
                        <th>ACTION</th>
                    </thead>

                    <tbody>
                        @foreach($staffs as $key => $t)
                            <tr>
                                <td>{{$key +1 }}</td>
                                <td><img src="{{$t->photo}}" style="height: 40px; width: 40px; border-radius: 25px;" class="img-fluid" /></td>
                                <td>{{$t->staff_no }}</td>
                                <td>{{$t->first_name." ".$t->last_name}}</td>
                                <td>{{$t->phone}}</td>
                                <td>{{$t->email}}</td>
                                <td>{{$t->staff_type}}</td>
                                <td>
                                    <button class="mini ui violet button"> <i class="uil uil-eye"></i> Details</button>
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
@stop

@section("scripts")
<script src="{{asset('assets/vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@include("app.includes.datatable_scripts")
<script src="{{asset('assets/vue/staff_list.js')}}"></script>
@stop