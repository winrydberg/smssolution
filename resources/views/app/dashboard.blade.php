@extends("app.includes.dashboard_master")

@section("page_styles")
<link href="{{asset('assets/css/student_dashboard.css')}}" rel="stylesheet">
@include("app.includes.datatable_css")
@include("app.includes.chart_scripts")

@stop


@section("content")
    <x-dashboard-component :studentcount="$student_count" :staffcount="$staff_count" :classescount="$classes_count" :totalfees="$total_fees" :term="$term">hhv</x-dashboard-component>

   <div class="row">
      <div class="col-md-4">
        <x-fee-statistics-component></x-fee-statistics-component>
      </div>
      <div class="col-md-4">
        <x-gender-statistics-component></x-fee-gender-component>
      </div>
      <div class="col-md-4">
        <div class="top_countries mt-30">
          <div class="top_countries_title">
              <h2>USEFUL LINKS</h2>
          </div>
          <div class="statement_content" id="vue-section">
              <a href="{{url('/accept-payment')}}" class="ui positive button block mb-3"><i class="fa fa-arrow-right"></i> Accept Payment</a>
              <a href="{{url('/generate-invoice')}}" class="ui blue button block mb-3"><i class="fa fa-arrow-right circle"></i> Generate Invoice</a>
              <a href="{{url('/unpaid-invoices')}}" class="ui violet button block mb-3"><i class="fa fa-arrow-right"></i> Pending Invoices / Payments</a>
              <a href="{{url('/revenue-reports')}}" class="ui orange button block mb-3"><i class="fa fa-arrow-right"></i> Payment / Revenue Reports</a>
              <a href="{{url('/expenditure-reports')}}" class="ui teal button block mb-3"><i class="fa fa-arrow-right"></i> Expenditure Reports</a>
          </div>
      </div>
      </div>
   </div>
    
    <div class="row">
        <div class="col-md-8">
            <x-payment-component :payments="$payments"></x-payment-component>
        </div>

        <div class="col-md-4">
            <div class="top_countries mt-30">
                <div class="top_countries_title">
                    <h2>EXPENDITURE CHARTS</h2>
                </div>
                <div class="statement_content" id="vue-section">
                    <canvas id="myChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section("scripts")
@include("app.includes.datatable_scripts")

<script src="{{asset('assets/vue/dashboard.js')}}"></script>


<script>
 $(document).ready(function(){
        var chartData = <?php echo $jsonData ?>;
        var ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
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