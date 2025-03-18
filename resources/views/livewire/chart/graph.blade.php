<div>
        <div id="lineChart"></div>
        
    @push('scripts')
    <script>
       document.addEventListener("DOMContentLoaded", function () {
           
            var chartData = @json($chartData);
            var chartLabels = @json($chartLabels);
            
            var lineOptions = {
                chart: {
                    type: 'line',
                    height: 300,
                    toolbar: {
                        show: true,
                        tools: {
                            zoom: true,
                            reset: true
                        }
                    },
                    zoom: {
                        enabled: true
                    }
                },
                series: [{
                    name: 'Leads',
                    data: chartData
                }],
                xaxis: {
                    categories: chartLabels,
                    title: { text: "Date" }
                },
                stroke: {
                    curve: 'smooth'
                },
                colors: ['#1E90FF'] // Blue line
            };

            var lineChart = new ApexCharts(document.querySelector("#lineChart"), lineOptions);        
            lineChart.render();
        });
    </script>
    @endpush
</div>
