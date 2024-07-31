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
<div class="row" id="vue-section">					
    <div class="col-lg-6 col-md-6">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>ACCEPT PAYMENT</h2>
            </div>
            <div class="statement_content">
                @if(!empty(request()->get("invoiceno")) && !empty(request()->get("sid")) )
                    <form id="acceptPayment" @submit.prevent="acceptPayment">
                        <input style="display:none;" class="prompt srch_explore form-control" value="{{request()->get("sid")}}" type="text" id="sid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="ui search focus mt-30 lbel25">
                                            <label>Invoice No <span style="color:red;">*</span></label>
                                            <div class="ui left icon input swdh19">	
                                                <input {{$invoice_info != null? 'readonly' : ''}} value="{{$invoice_info != null ? $invoice_info->invoice_no : null}}" required class="prompt srch_explore form-control" type="text" id="invoice_no">
                                                <small style="color:red;">Enter the invoice no to accept payment</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="ui search focus mt-30 lbel25">
                                            <label>Invoice Amount <span style="color:red;">*</span></label>
                                            <div class="ui left icon input swdh19">	
                                                <input {{$invoice_info != null? 'readonly' : ''}} value="{{$invoice_info != null ? $invoice_info->amount : null}}" required class="prompt srch_explore form-control" type="text" name="invoice_amount">
                                                <small style="color:red;">Total amount on invoice</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="ui search focus mt-20 lbel25">
                                    <label>Student Admission NO <span style="color:red;">*</span></label>
                                    <div class="ui left icon input swdh19">	
                                        <input {{$invoice_info != null? 'readonly' : ''}} value="{{$invoice_info != null ? $invoice_info->student->admission_no : null}}" required class="prompt srch_explore form-control" type="text" name="admission_no">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="ui search focus mt-20 lbel25">
                                            <label>Amount To Pay <span style="color:red;">*</span></label>
                                            <div class="ui left icon input swdh19">	
                                                <input v-model="amount_to_pay" required class="prompt srch_explore form-control" type="text" name="amount_to_pay">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ui search focus mt-20 lbel25">
                                            <label>Date of Payment <span style="color:red;">*</span></label>
                                            <div class="ui left icon input swdh19">	
                                                <input value="{{date("Y-m-d")}}" required class="prompt srch_explore form-control" type="date" id="paid_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-lg-12 col-md-12">
                                    <button  class="ui purple button block" type="submit"><i class="fa fa-search"></i> Accept Payment</button>
                                    </div>
                                </div>
                            </div>	
                        </div>
                    </form>
                @else
                    <form id="invoiceSearch" @submit.prevent="searchInvoice">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="ui search focus mt-30 lbel25">
                                    <label>Invoice No <span style="color:red;">*</span></label>
                                    <div class="ui left icon input swdh19">	
                                        <input v-model="invoice_no" required class="prompt srch_explore form-control" type="text" name="category">
                                        <small style="color:red;">Enter the invoice no to accept payment</small>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-12 col-md-12">
                                    <button  class="ui purple button block" type="submit"><i class="fa fa-search"></i> Find Student's Invoice</button>
                                    </div>
                                </div>
                            </div>	
                        </div>
                    </form>
                @endif
            </div>
        </div>			
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>STUDENT INFO</h2>
            </div>
            <div class="statement_content">
                @if(!is_null($invoice_info) && !is_null($invoice_info->student))
                <?php  $student = $invoice_info->student; ?>
                <div class="profile_image d-flex align-items-center justify-content-center mb-3">
                    @if(!is_null($student) && $student->photo != null )
                        <img src="{{$student->photo}}" style="height: 100px; width: 100px; border-radius: 50px;" alt="profile" />
                    @else
                        <img src="{{asset('assets/images/hd_dp.jpg')}}" style="height: 100px; width: 100px; border-radius: 50px;" class="" alt="profile" />
                    @endif
                </div>
                <table class="table table-bordered table-striped table-hover" id="student_table">
                    <thead>
                        <th>FIELD</th>
                        <th>VALUE</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Admission NO</td>
                            <td>{{$student?->admission_no}}</td>
                        </tr>
                        <tr>
                            <td>Student ID</td>
                            <td>{{$student?->student_id}}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{$student?->first_name." ".$student->last_name}}</td>
                        </tr>
                        <tr>
                            <td>Guardian Name</td>
                            <td>{{$student?->guardian?->first_name." ".$student->guardian?->last_name}}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="col-md-6 mt-5">
                    <a href="{{url('/accept-payment')}}" class="ui orange button block" type="submit"><i class="fa fa-search"></i> Not The Student</a>
                </div>
                @endif
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
<script src="{{asset('assets/vue/accept_payment.js')}}"></script>


@stop