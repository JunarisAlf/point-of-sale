<div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

    <div class="col-span-1 xl:col-span-12">
        <div class="card dark:border-zinc-600 dark:bg-zinc-800">
            <div class="card-body flex flex-wrap gap-3">
                <div id="category_chart" wire:ignore data-colors='["#2ab57d", "#5156be", "#fd625e", "#4ba6ef", "#ffbf53"]'
                    class="apex-charts w-full" dir="ltr"></div>
            </div>
        </div>
    </div>

    <script>
        let chart;
        function getChartColorsArray(chartId) {
            var colors = $(chartId).attr('data-colors');
            var colors = JSON.parse(colors);
            return colors.map(function(value) {
                var newValue = value.replace(' ', '');
                if (newValue.indexOf('--') != -1) {
                    var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                    if (color) return color;
                } else {
                    return newValue;
                }
            })
        }
        // pie chart
        function renderChart(series, labels) {
            var pieColors = getChartColorsArray("#category_chart");
            var options = {
                chart: {
                    type: 'pie',
                },
                series: series,
                labels: labels,
                colors: pieColors,
                legend: {
                    show: true,
                    position: 'bottom',
                    horizontalAlign: 'center',
                    verticalAlign: 'middle',
                    floating: false,
                    fontSize: '14px',
                    offsetX: 0,
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        chart: {
                            height: 240
                        },
                        legend: {
                            show: false
                        },
                    }
                }]

            }
            chart = new ApexCharts(
                document.querySelector("#category_chart"),
                options
            );
            chart.render();

        }
        document.addEventListener("DOMContentLoaded", () => {
            let series =@js($series);
            let labels = @js($labels);
            // console.log(series, labels);
            renderChart(series, labels);
        });
    </script>
</div>
