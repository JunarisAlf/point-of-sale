<div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
    <div class="col-span-1 xl:col-span-12 flex flex-col md:flex-row gap-4 justify-between">
        <div wire:ignore id="sell-range" style="background: #fff; cursor: pointer; width: auto">
            <span></span> <i class="fa fa-caret-down"></i>
        </div>
        <div class="">
            <select class="py-2 px-4 pr-8 dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100" wire:model="cabang_id">
                <option value="all">Semua Cabang</option>
                @foreach ($cabangSelect as $cb)
                    <option value="{{$cb->id}}">{{$cb->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-span-1 xl:col-span-12">
        <div class="card dark:border-zinc-600 dark:bg-zinc-800">
            <div class="card-body flex flex-wrap gap-3">
                <div wire:ignore id="line_chart_datalabel" data-colors='["#5156be", "#2ab57d"]' class="apex-charts h-[90vh] w-full"
                    dir="ltr"></div>
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

            //  line chart datalabel
            function renderChart(series, xAxis) {
                var lineDatalabelColors = getChartColorsArray("#line_chart_datalabel");
                var options = {
                    chart: {
                        type: 'line',
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false
                        }
                    },
                    colors: lineDatalabelColors,
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        width: [3, 3],
                        curve: 'straight'
                    },
                    series: series,
                    grid: {
                        row: {
                            colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.2
                        },
                        borderColor: '#f1f1f1'
                    },
                    markers: {
                        style: 'inverted',
                        size: 0
                    },
                    xaxis: xAxis,
                    yaxis: {
                        title: {
                            text: 'Total (Rp.)'
                        },
                        min: 1000,
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        floating: true,
                        offsetY: -25,
                        offsetX: -5
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                toolbar: {
                                    show: false
                                }
                            },
                            legend: {
                                show: false
                            },
                        }
                    }]
                }

                chart = new ApexCharts(document.querySelector("#line_chart_datalabel"), options);
                chart.render();
            }
            document.addEventListener("DOMContentLoaded", () => {
                let series =[ @js($series)];
                let xAxis = @js($labels);
                renderChart(series, xAxis);
            });
            window.addEventListener('refresh', data => {
                let series = JSON.parse(data.detail.series);
                let xAxis = JSON.parse(data.detail.xAxis);
                console.log(series);
                chart.updateSeries([{
                    data: series.data
                }]);
                chart.updateOptions({ xaxis: { categories: xAxis.categories}})
                // renderChart(series, xAxis);
            })

        </script>
</div>
