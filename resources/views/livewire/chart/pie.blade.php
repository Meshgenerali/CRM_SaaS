<div>
    <div id="pieChart"></div>

    @push('scripts')
    <script>
           document.addEventListener("DOMContentLoaded", function () {
            var pieOptions = {
                chart: {
                    type: 'pie',
                    height: 300
                },
                series: {!! $chartData !!}, 
                labels: {!! $chartLabels !!}, 
                colors: ['#1E90FF', '#FFA500', '#32CD32'], 
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#pieChart"), pieOptions);
            chart.render();
        });
    </script>
    @endpush
</div>
