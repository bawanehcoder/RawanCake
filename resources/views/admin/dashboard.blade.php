@extends('admin.layout.master')

@section('title')
    @langucw('Dashboard')
@endsection
@section('css')
@endsection
@php
    $ipObj = app()->make(\App\Services\IpApiAdapter::class, ['ip' => null]);
    //     $ipObj->getIpInfo();
    $countryCode = $ipObj->getCountryCode();
@endphp
@section('content')
    <div class="row sales-cards">
        <div class="col-xl-6 col-sm-12 col-12">
            <div class="card d-flex align-items-center justify-content-between default-cover mb-4">
                <div>
                    <h6>Weekly Earning</h6>
                    <h3>$<span class="counters" data-count="{{ $salesCount }}">{{ $salesCount }}</span></h3>
                    <p class="sales-range"><span class="text-success"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-up feather-16">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>48%&nbsp;</span>increase compare to last week</p>
                </div>
                <img src="{{ asset('assets/img/icons/weekly-earning.svg') }}" alt="img">
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card color-info bg-primary mb-4">
                <img src="assets/img/icons/total-sales.svg" alt="img">
                <h3 class="counters" data-count="{{ $usersCount }}">{{ $usersCount }}</h3>
                <p>No of Registered Users

                </p>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-rotate-ccw feather-16" data-bs-toggle="tooltip" data-bs-placement="top"
                    aria-label="Refresh" data-bs-original-title="Refresh">
                    <polyline points="1 4 1 10 7 10"></polyline>
                    <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                </svg>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card color-info bg-secondary mb-4">
                <img src="assets/img/icons/purchased-earnings.svg" alt="img">
                <h3 class="counters" data-count="{{ $salesCount }}"">{{ $salesCount }}</h3>
                <p>No of Total Sales</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-rotate-ccw feather-16" data-bs-toggle="tooltip" data-bs-placement="top"
                    aria-label="Refresh" data-bs-original-title="Refresh">
                    <polyline points="1 4 1 10 7 10"></polyline>
                    <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                </svg>
            </div>
        </div>
    </div>


    <div class="row sales-board">
        <div class="col-md-12 col-lg-12 col-sm-12 col-12">
            <div class="card flex-fill default-cover">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Sales Analytics</h5>

                </div>
                <div class="card-body">
                    <div id="sales-analysis" class="chart-set" style="min-height: 288px;">
                        
                    </div>
                </div>
            </div>
        </div>
       
    </div>
@endsection
@section('scripts')
@php
    $trend = \Flowframe\Trend\Trend::model(\App\Models\Order::class)
    ->between(
            start: now()->subYear(),
            end: now(),
        )
        ->perMonth()
        ->count();

    // dd($trend->map(fn (\Flowframe\Trend\TrendValue $value) => $value->aggregate));
@endphp
<script type="text/javascript">
 if ($('#sales-analysis').length > 0) {
    var options = {
      series: [{
        name: "Sales Analysis",
        data: {{ $trend->map(fn (\Flowframe\Trend\TrendValue $value) => $value->aggregate) }}
      }],
      chart: {
        height: 273,
        type: 'area',
        zoom: {
          enabled: false
        }
      },
      colors: ['#9E76B4'],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight'
      },
      title: {
        text: '',
        align: 'left'
      },
      // grid: {
      //   row: {
      //     colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
      //     opacity: 0.5
      //   },
      // },
      xaxis: {
        categories: {{ $trend->map(fn (\Flowframe\Trend\TrendValue $value) => $value->aggregate) }},
      },
      
      legend: {
        position: 'top',
        horizontalAlign: 'left'
      }
    };

    var chart = new ApexCharts(document.querySelector("#sales-analysis"), options);
    chart.render();
  }
</script>
@endsection
