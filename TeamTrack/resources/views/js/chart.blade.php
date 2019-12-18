<script type="text/javascript">


    window.onload = loadChart();

    function reloadChartData(){
        console.log('define reloadChartData');

        if(window.location.pathname.includes('teams'))
        {
            barChartData = {
                labels: [{{ implode(',', $sprints) }}],
                datasets: [{
                    label: 'Completed Tasks',
                    backgroundColor: window.chartColors.blue,
                    data: document.getElementById('completed_task_array').innerHTML
                }, {
                    label: 'Overdue Tasks',
                    backgroundColor: window.chartColors.red,
                    data: document.getElementById('overdue_task_array').innerHTML
                },{
                    label: 'Scheduled Tasks',
                    backgroundColor: window.chartColors.grey,
                    data: document.getElementById('scheduled_task_array').innerHTML
                }]
            };
        }

    };
    
    function loadChart() {

        console.log("define loadChart");

        if(window.location.pathname.includes('teams'))
        {
                
            reloadChartData();
            console.log('reload Chart');
            console.log(window.location.pathname.includes('teams'));
            console.log(barChartData);

            var ctx = document.getElementById('canvas').getContext('2d');
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    title: {
                        display: true,
                        
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });

        }

        
    };

</script>