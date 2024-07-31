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

<div class="row" >					
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="top_countries mt-30">
                <div class="top_countries_title">
                    <h2>STUDENT DETAILS</h2>
                </div>
                <div class="statement_content">
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
                                <td>First Name</td>
                                <td>{{$student?->first_name}}</td>
                            </tr>
                            <tr>
                                <td>Middle Name</td>
                                <td>{{$student?->middle_name}}</td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>{{$student?->last_name}}</td>
                            </tr>
                            <tr>
                                <td>Class</td>
                                <td>{{$student?->sclass->name}}</td>
                            </tr>
                            <tr>
                                <td>Sub Class</td>
                                <td>{{$student?->sub_class?->name}}</td>
                            </tr>
                            <tr>
                                <td>House No</td>
                                <td>{{$student?->guardian?->house_no}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>			
        </div>
    
        <div class="col-lg-6 col-md-6">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card_dash">
                    <div class="card_dash_left">
                        <h5>Total Fees Pending</h5>
                        <h2 style="color:red;">GHC {{$total_pending_fees}}</h2>
                        {{-- <span class="crdbg_4">New 245</span> --}}
                        <button class="ui green button" @click="generateAllInvoices()"><i class="fa fa-file"></i> Generate Invoice For All</button>
                    </div>
                    <div class="card_dash_right">
                        <img src="{{asset('assets/images/dashboard/knowledge.svg')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="top_countries mt-30">
                <div class="top_countries_title">
                    <h2>GUARDIAN DETAILS</h2>
                </div>
                <div class="statement_content">
                   <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="guardian_table">
                            <thead>
                                <th>FIELD</th>
                                <th>VALUE</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>First Name</td>
                                    <td>{{$student?->guardian?->first_name}}</td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td>{{$student?->guardian?->last_name}}</td>
                                </tr>
                                <tr>
                                    <td>Phone No</td>
                                    <td>{{$student?->guardian?->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$student?->guardian?->email}}</td>
                                </tr>
                                <tr>
                                    <td>House No</td>
                                    <td>{{$student?->guardian?->house_no}}</td>
                                </tr>
                                <tr>
                                    <td>Occupation</td>
                                    <td>{{$student?->guardian?->occupation}}</td>
                                </tr>
                            </tbody>
                        </table>
                   </div>
                </div>
            </div>			
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="top_countries mt-30">
                <div class="top_countries_title">
                    <h2>PENDING FEES</h2>
                </div>
                <div class="statement_content">
                <button v-show="selected_fees.length > 0" @click="generateInvoiceForSelectedFees()" class="ui orange button "><i class="fa fa-file"></i> Generate Invoice For Selected fees</button>

                <div class="table-responsive">
                        @if($student!= null)
                            <table class="table table-striped text-nowrap" id="pending_fees">
                                <thead>
                                    <th>#ID</th>
                                    <th>SELECT</th>
                                    <th>FEE TYPE</th>
                                    <th>ACADEMIC YEAR</th>
                                    <th>AMOUNT</th>
                                    <th>STATUS</th>
                                </thead>
            
                                <tbody>
                                    @foreach($fees_pending as $key => $p)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td><input type="checkbox" name="fee_id" v-model="selected_fees" value="{{$p->id}}"/></td>
                                            <td>{{$p->name}}</td>
                                            <td>{{$p->academic_year}}</td>
                                            <td>{{$p->amount}}</td>
                                            <td><span class="ui orange tag label small">PENDING</span></td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                </div>
                </div>
            </div>			
        </div>
    </div>

   <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="top_countries mt-30">
                <div class="top_countries_title">
                    <h2>PAYMENTS HISTORY</h2>
                </div>
                <div class="statement_content">
                <div class="table-responsive">
                        @if($student!= null)
                            <table class="table table-striped text-nowrap" id="paid_fees">
                                <thead>
                                    <th>#ID</th>
                                    <th>INVOICE NO#</th>
                                    <th>AMOUNT</th>
                                    <th>FEE TYPE</th>
                                    <th>STATUS</th>
                                    <th>DATE PAID</th>
                                    <th>TERM</th>
                                    <th>ACTION</th>
                                </thead>
            
                                <tbody>
                                    @foreach($student->payments as $key => $p)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$p->invoice_no}}</td>
                                            <td>{{$p->amount}}</td>
                                            <td>{{$p->fee?->name}}</td>
                                            <td><span class="ui green tag label small">SUCCESSFUL</span></td>
                                            <td>{{date("F j, Y", strtotime($p->created_at))}}</td>
                                            <td>{{$p->term?->name}}</td>
                                            <td>
                                                <a href="{{url('print-receipt?invoiceno='.$p->invoice_no.'&sid='.$student->id)}}" class="mini ui teal button"><i class="fa fa-print"></i> Print Receipt</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include("app.includes.datatable_scripts")
<script src="{{asset('assets/vue/student_details.js')}}"></script>


@stop