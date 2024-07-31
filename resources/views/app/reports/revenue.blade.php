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
                <h2>FILTER REVENUE</h2>
            </div>
            <div class="statement_content">
                <form method="GET">
                    {{csrf_field()}}
                    <input style="display:none;" class="prompt srch_explore form-control" value="1" type="date" name="search">
                    <input style="display: none;" class="prompt srch_explore form-control" value="1" type="text" name="search">
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <div class="ui search focus mt-2 lbel25">
                                <label>Term </label>
                                <div class="ui left icon input swdh19">	
                                    <select class="form-control prompt srch_explore" name="term">
                                        <option value="">Select an option</option>
                                        @foreach($terms as $t)
                                            <option value="{{$t->id}}">{{$t->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="ui search focus mt-2 lbel25">
                                <label>Academic Year </label>
                                <div class="ui left icon input swdh19">	
                                    <select class="form-control prompt srch_explore" name="acad_yr">
                                        <option value="">Select an option</option>
                                        @foreach($academic_years as $yr)
                                            <option value="{{$yr->academic_year}}">{{$yr->academic_year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="ui search focus mt-2 lbel25">
                                <label>Class </label>
                                <div class="ui left icon input swdh19">	
                                    <select class="form-control prompt srch_explore" name="mclass">
                                        <option value="">Select an option</option>
                                        @foreach($classes as $c)
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="ui search focus mt-2 lbel25">
                                <label>Sub Class </label>
                                <div class="ui left icon input swdh19">	
                                    <select class="form-control prompt srch_explore" name="sclass">
                                        <option value="">Select an option</option>
                                        @foreach($sub_classes as $c)
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="ui search focus mt-2 lbel25">
                                <label>Start Date </label>
                                <div class="ui left icon input swdh19">	
                                    <input class="prompt srch_explore form-control" value="{{request()->get("startdate")}}" type="date" name="start">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="ui search focus mt-2 lbel25">
                                <label>End Date </label>
                                <div class="ui left icon input swdh19">	
                                    <input class="prompt srch_explore form-control" value="{{request()->get("enddate")}}" type="date" name="end">
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
    <div class="col-lg-7 col-md-7">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>REVENUE REPORTS</h2>
            </div>
            <div class="statement_content">
               <div class="table-responsive">
                <table class="table table-striped text-nowrap" id="students">
                    <thead>
                        <th>#ID</th>
                        <th>FEE TYPE</th>
                        <th>AMOUNT({{env("CURRENCY")}})</th>
                        <th>INVOICE CATEGORY</th>
                        <th>PAYMENT DATE</th>
                        <th>ADMISSION NO</th>
                        <th>ACADEMIC YEAR</th>
                        <th>TERM</th>
                        {{-- <th>ACTION</th> --}}
                    </thead>

                    <tbody>
                     
                       
                    </tbody>
                </table>
               </div>
            </div>
        </div>			
    </div>

    <div class="col-lg-5 col-md-5">
        <div class="top_countries mt-30">
            <div class="top_countries_title">
                <h2>REVENUE CHARTS</h2>
            </div>
            <div class="statement_content" id="vue-section">
                <canvas id="myChart" width="400" height="300"></canvas>
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
@include("app.includes.chart_scripts")
<script src="{{asset('assets/vue/students.js')}}"></script>

<script>
    $(document).ready(function(){
           var chartData = <?php echo $jsonData ?>;
           var ctx = document.getElementById('myChart').getContext('2d');
           var myChart = new Chart(ctx, {
               type: 'bar', // You can change this to 'line', 'pie', etc.
               data: chartData,
               options: {
                   scales: {
                       y: {
                           beginAtZero: true
                       }
                   }
               }
           });
    })
</script>


@stop