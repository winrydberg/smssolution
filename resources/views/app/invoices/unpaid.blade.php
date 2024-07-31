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
    <div class="col-lg-12 col-md-12">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>UNPAID INVOICES</h2>
            </div>
            <div class="statement_content">
               <div class="table-responsive">
                <table class="table table-striped text-nowrap" id="unpaid">
                    <thead>
                        <th>#ID</th>
                        <th>INVOICE ID</th>
                        <th>ADMISSION NO</th>
                        <th>STUDENT ID</th>
                        <th>STUDENT NAME</th>
                        <th>GUARDIAN NAME</th>
                        <th>GUARDIAN PHONE</th>
                        <th>AMOUNT({{env("CURRENCY")}})</th>
                        <th>STATUS</th>
                        <th>ACADEMIC YEAR</th>
                        <th>GENERATED AT</th>
                        <th>ACTION</th>
                    </thead>

                    <tbody>
                        @foreach($invoices as $key => $in)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$in->invoice_no}}</td>
                                <td>{{$in->student?->admission_no}}</td>
                                <td>{{$in->student?->student_id}}</td>
                                <td>{{$in->student?->first_name." ".$in->student?->last_name}}</td>
                                <td>{{$in->guardian?->first_name." ".$in->guardian?->last_name}}</td>
                                <td>{{$in->guardian?->phone}}</td>
                                <td>{{$in->amount}}</td>
                                <td><span class="small ui orange tag label">PENDING</span></td>
                                <td>{{$in->academic_year}}</td>
                                <td>{{date("F j, Y", strtotime($in->created_at))}}</td>
                                <td>
                                    <a href="{{url('accept-payment?invoiceno='.$in->invoice_no.'&sid='.$in?->student?->id)}}" class="mini ui primary button"><i class="fa fa-credit-card"></i> Accept Payment</a>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include("app.includes.datatable_scripts")
<script src="{{asset('assets/vue/unpaid.js')}}"></script>

@stop