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
<div class="row">					
    <div class="col-lg-12 col-md-12">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>FILTER PAYMENTS</h2>
            </div>
            <div class="statement_content">
                <form method="GET">
                    {{csrf_field()}}
                    <input style="display: none;" class="prompt srch_explore form-control" value="1" type="text" name="search">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="ui search focus mt-2 lbel25">
                                <label>Admission NO# </label>
                                <div class="ui left icon input swdh19">	
                                    <input class="prompt srch_explore form-control" value="{{request()->get("admissionno")}}" type="text" name="admissionno">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="ui search focus mt-2 lbel25">
                                <label>Receipt NO# </label>
                                <div class="ui left icon input swdh19">	
                                    <input class="prompt srch_explore form-control" value="{{request()->get("receiptno")}}" type="text" name="receiptno">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4">
                            <div class="ui search focus mt-2 lbel25">
                                <label>Class </label>
                                <div class="ui left icon input swdh19">	
                                    <select class="selectpicker form-control" name="class">
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
<div class="row" id="vue-section">					
    <div class="col-lg-12 col-md-12">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>PAYMENTS</h2>
            </div>
            <div class="statement_content">
               <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap" id="payments">
                        <thead>
                            <th>#ID</th>
                            <th>RECEIPT#</th>
                            <th>ADMISSION NO</th>
                            <th>STUDENT NAME</th>
                            <th>AMOUNT</th>
                            <th>STATUS</th>
                            <th>PARENT NAME</th>
                            <th>DATE PAID</th>
                            <th>ACTION</th>
                        </thead>
    
                        <tbody>
                            @foreach($payments as $key => $p)
                                <tr>
                                   <td>{{$key + 1}}</td>
                                   <td>{{$p->receipt_no}}</td>
                                   <td>{{$p->student?->admission_no}}</td>
                                   <td>{{$p->student?->first_name." ".$p->student->last_name}}</td>
                                   <td>{{$p->amount}}</td>
                                   <td><span class="small ui green tag label">PAID</span></td>
                                   <td>{{$p->student?->guardian?->first_name." ".$p->student?->guardian?->last_name}}</td>
                                   <td>{{date("F j, Y", strtotime($p->created_at))}}</td>
                                   <td>
                                    <a href="{{url('/pay-receipt?payid='.$p->id)}}" target="_blank" class="mini ui teal button"><i class="fa fa-print"></i> Receipt</a>
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
</div>
@stop

@section("scripts")
<script src="{{asset('assets/vendor/bootstrap-select/docs/docs/dist/js/bootstrap-select.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include("app.includes.datatable_scripts")
<script src="{{asset('assets/vue/payments.js')}}"></script>

@stop