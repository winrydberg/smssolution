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
    <div class="col-lg-12 col-md-12">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>INVOICE CATEGORIES</h2>
            </div>
            <div class="statement_content">
               <div class="table-responsive">
                <table class="table table-striped text-nowrap" id="invoice_categories">
                    <thead>
                        <th>#ID</th>
                        <th>CATEGORY CODE</th>
                        <th>DESCRIPTION</th>
                        <th>FEES</th>
                        <th>GENERATED DATE</th>
                        <th>TOTAL INVOICES</th>
                        <th>ACTION</th>
                    </thead>

                    <tbody>
                        @foreach($categories as $key => $c)
                            <tr>
                                <td>{{$key +1 }}</td>
                                <td>{{$c->name}}</td>
                                <td>{{$c->extras}}</td>
                                <td>
                                    <?php 
                                       $fee_names = json_decode($c->fees);
                                    ?>
                                    @foreach($fee_names as $key => $fee)
                                        <a class="ui teal tag label">{{$fee}}</a>
                                    @endforeach
                                </td>
                                <td>
                                    {{date("F j, Y", strtotime($c->created_at))}}
                                </td>
                                <td>{{$c->pending_payments_count}}<td>
                                    <button class="mini ui violet button"> <i class="uil uil-eye"></i> All Invoices</button>
                                    <button class="mini ui red button" @click="deleteInvoiceCategory('{{$c->id}}')"> <i class="uil uil-trash-alt"></i> Delete Invoice(s)</button>
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
<script src="{{asset('assets/vue/invoice_categories.js')}}"></script>


@stop