<div class="card">
    <div class="card-header flex-column align-items-start pb-0">
        <div class="avatar bg-light-success p-50 m-0">
            <div class="avatar-content">
                <i class='fas fa-users fa-xl' style='color:#1DBF73;'></i>
            </div>
        </div>
        <h2 class="font-weight-bolder mt-1">{{ $usersCount }}</h2>
        <p class="card-text">@langucw('registered users')</p>
    </div>
    <div id="registered_user_statistics_block"></div>
</div>


@push('scripts')

    <script>
        var lineAreaChart = document.querySelector('#registered_user_statistics_block');

        gainedChartOptions = {
            chart: {
                height: 100,
                type: 'area',
                toolbar: {
                    show: false
                },
                sparkline: {
                    enabled: true
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0
                    }
                }
            },
            colors: ['#1DBF73'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2.5
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 0.9,
                    opacityFrom: 0.7,
                    opacityTo: 0.5,
                    stops: [0, 80, 100]
                }
            },
            series: [
                {
                    name: 'registereds',
                    data: {{ json_encode(array_column($usersStatistics,'count')) }}
                }
            ],
            xaxis: {
                labels: {
                    show: false
                },
                axisBorder: {
                    show: true
                }
            },
            yaxis: [
                {
                    y: 0,
                    offsetX: 0,
                    offsetY: 0,
                    padding: { left: 0, right: 0 }
                }
            ],
            xaxis: {
                categories: {!! json_encode(array_column($usersStatistics,'period')) !!},
            },
            tooltip: {
                x: { show: true }
            }
        };

        gainedChart = new ApexCharts(lineAreaChart, gainedChartOptions);
        gainedChart.render();
    </script>
@endpush
