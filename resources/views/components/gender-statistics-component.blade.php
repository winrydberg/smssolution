<div class="top_countries mt-30">
    <div class="top_countries_title">
        <h2>GENDER STATS</h2>
    </div>
    <div class="statement_content">
        <canvas id="genderChart" height="200"></canvas>
    </div>
</div>

<script>
    $(document).ready(function(){
           var chartData = <?php echo json_encode($chart_data) ?>;
           var ctx = document.getElementById('genderChart').getContext('2d');
           var myChart = new Chart(ctx, {
               type: 'pie', // You can change this to 'line', 'pie', etc.
               data: chartData,
               options: {
                    tooltips: {
                        enabled: true,
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        datalabels: {
                            formatter: (value, categories) => {

                                    let sum = 0;
                                    let dataArr = categories.chart.data.datasets[0].data;
                                    dataArr.map(data => {
                                        sum += data;
                                    });
                                    let percentage = (value*100 / sum).toFixed(2)+"%";
                                    return percentage;


                                },
                            color: '#fff',
                        }
                    }
                }
           });
    })
</script>
