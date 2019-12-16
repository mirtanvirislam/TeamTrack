<html>

@include('layouts.cssimports')
@include('js.jsimports')
{{-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script> --}}

<body>
    <div class="container p-4">
        <div class="row justify-content-center card p-4">
            <div class="col-md-8 p-4">
                <h1>About TeamTrack</h1>
                <hr>
                <h5>
                    Make work life simpler, more pleasant and more productive.
                </h5>
                
                <canvas id="canvas" width="400" height="200"></canvas>

                <script>
                    var barChartData = {
                        labels: ['Sprint 1', 'Sprint 2', 'Sprint 3', 'Sprint 4', 'Sprint 5', 'Sprint 6', 'Sprint 7'],
                        datasets: [{
                            label: 'Completed Tasks',
                            backgroundColor: window.chartColors.blue,
                            data: [4, 3, 2, 0, 0, 0,0]
                        }, {
                            label: 'Overdue Tasks',
                            backgroundColor: window.chartColors.red,
                            data: [
                                0,0,1,0,0,0,0
                            ]
                        },{
                            label: 'Scheduled Tasks',
                            backgroundColor: window.chartColors.grey,
                            data: [
                                0,0,0,3,4,3,4
                            ]
                        }]

                    };
                    window.onload = function() {
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
                    };
                </script>

            </div>
        </div>
    </div>
</body>
