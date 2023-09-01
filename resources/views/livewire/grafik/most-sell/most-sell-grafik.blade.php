<div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
    <div class="col-span-1 flex flex-col justify-between gap-4 md:flex-row xl:col-span-12">
        <div wire:ignore id="sell-range" style="background: #fff; cursor: pointer; width: auto">
            <span></span> <i class="fa fa-caret-down"></i>
        </div>
        <div class="">
            <select
                class="w-full rounded border-gray-100 px-4 py-2 py-2.5 pr-8 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-700 dark:bg-zinc-700/50 dark:bg-zinc-800 dark:text-zinc-100"
                wire:model="cabang_id">
                <option value="all">Semua Cabang</option>
                @foreach ($cabangSelect as $cb)
                    <option value="{{ $cb->id }}">{{ $cb->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-span-1 xl:col-span-12">
        <div class="card dark:border-zinc-600 dark:bg-zinc-800">
            <div class="card-body flex flex-wrap gap-3">
                <div wire:ignore id="bar_chart" data-colors='["#2ab57d"]' class="apex-charts w-full" dir="ltr">
                </div>

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

        //  Bar Chart
        function renderChart(items, sellCount) {
            var barColors = getChartColorsArray("#bar_chart");
            var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    data: sellCount
                }],
                colors: barColors,
                grid: {
                    borderColor: '#f1f1f1',
                },
                xaxis: {
                    categories: items,
                }
            }

            chart = new ApexCharts(
                document.querySelector("#bar_chart"),
                options
            );

            chart.render();
        }
        document.addEventListener("DOMContentLoaded", () => {
            let items = @js($items);
            let sellCount = @js($sellCount);
            renderChart(items, sellCount);
        });
        window.addEventListener('refresh', data => {
            let items = JSON.parse(data.detail.items);
            let sellCount = JSON.parse(data.detail.sellCount);
            chart.updateSeries([{
                    data: sellCount
            }]);
            chart.updateOptions({ xaxis: { categories: items}})
            // renderChart(series, xAxis);
        })
    </script>
</div>
