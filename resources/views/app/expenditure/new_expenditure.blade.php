@extends("app.includes.dashboard_master")

@section("page_styles")
<link href="{{asset('assets/css/student_dashboard.css')}}" rel="stylesheet">
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
                <h2>LOG NEW EXPENDITURE</h2>
            </div>
            <div class="statement_content">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-6 ">
                        <form @submit.prevent="saveExpenditure">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="mt-30 lbel25">
                                        <label>Expenditure Category</label>
                                    </div>
                                    <select class="selectpicker" required v-model="form.category" title="Select Fees" name="fees[]">
                                        <option value="" disabled>Select an option</option>	
                                        @foreach($categories as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>	
                                        @endforeach																						
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Description <span style="color:red;">*</span></label>
                                        <div class="ui left icon input swdh19">	
                                            <textarea required class="prompt srch_explore form-control" name="description" v-model="form.description" rows="3"></textarea>
                                            <small style="color:red;">Short description of the expenditure</small>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-8">
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Amount Spent <span style="color:red;">*</span></label>
                                        <div class="ui left icon input swdh19">	
                                            <input v-model="form.amount" required class="prompt srch_explore form-control" type="text" name="amount">
                                        </div>
                                    </div>
                                </div>	
                                <div class="col-lg-4 col-md-4">
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>Date Spent <span style="color:red;">*</span></label>
                                        <div class="ui left icon input swdh19">	
                                            <input v-model="form.spent_date" required class="prompt srch_explore form-control" type="date" name="category">
                                        </div>
                                    </div>
                                </div>	
                            </div>

                            <div class="row mt-5">
                                <div class="col-lg-12 col-md-12">
                                   <button class="ui purple button block" type="submit"><i class="fa fa-save"></i> Log Expenditure</button>
                                </div>
                            </div>
                        </form>
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
<script src="{{asset('assets/vue/new_expenditure.js')}}"></script>
@stop