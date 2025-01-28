@extends('admin.layout.master')
@section('title')
    {{ trans('general.sales_report') }}
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="#">{{ trans('general.requests') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('general.sales_report') }}</li>
@endsection
@section('content')
    @include('components.messagesAndErrors')
    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class=" card table-list-card">
                    <div class=" card table-list-card-header ">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>@langucw('payment method')</label>
                                <select name="payment_method" autocomplete="off" id="payment_method"
                                    class="select payment_method form-control form-control-sm  w-100">
                                    <option value="all">@langucw('all')</option>
                                    <option value="cash_on_delivery">@langucw('cash on delivery')</option>
                                    <option value="electronic_payment">@langucw('electronic payment')</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>@langucw('receiving method')</label>
                                <select name="receiving_method" autocomplete="off" id="receiving_method"
                                    class="select  receiving_method form-control form-control-sm w-100">
                                    <option value="all">@langucw('all')</option>
                                    <option value="personal_pickup">@langucw('personal pickup')</option>
                                    <option value="delivery_address">@langucw('delivery address')</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <div style="margin-top: 20px">
                                    <a onclick="event.preventDefault();exportExel();"
                                        class="btn btn-success float-right">@langucw('export to Excel') </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-top">
                        <div class="search-set">


                            <div class="search-input">
                                <a href="javascript:void(0);" class="btn btn-searchset"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg></a>

                            </div>

                            <div class="f-input">
                                @include('components.date-range-input')

                            </div>


                        </div>
                        <div class="search-path">

                        </div>
                        <div class="form-sort">
                        </div>
                    </div>
                    <div class=" card-body table-list-card-body">
                        <table class=" table no-footerdata-table  data-table">
                            <thead>
                                <tr>
                                    <th>{{ trans('general.id') }}</th>
                                    <th>@langucw('source')</th>
                                    <th>@langucw('payment method')</th>
                                    <th>{{ trans('general.name') }}</th>
                                    <th>@langucw('phone')</th>
                                    <th>@langucw('address')</th>
                                    <th>@langucw('delivery time')</th>
                                    <th>@langucw('the amount required')</th>
                                    <th>{{ trans('general.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        function exportExel() {

            window.location.href = "{{ route('dashboard.sales-report.export-sales-report') }}?payment_method=" + $(
                    '#payment_method').val() + "&receiving_method=" + $('#receiving_method').val() +
                "&from_date={{ \Request()->input('from_date') }}&to_date={{ \Request()->input('to_date') }}";

        }


        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                bFilter: true,
                sDom: 'fBtlpi',
                ordering: true,
                language: {
                    search: ' ',
                    sLengthMenu: '_MENU_',
                    searchPlaceholder: "Search",
                    info: "_START_ - _END_ of _TOTAL_ items",
                    paginate: {
                        next: ' <i class=" fa fa-angle-right"></i>',
                        previous: '<i class="fa fa-angle-left"></i> '
                    },
                },
                initComplete: (settings, json) => {
                    $('.dataTables_filter').appendTo('#tableSearch');
                    $('.dataTables_filter').appendTo('.search-input');

                },
                ajax: {
                    url: "{{ route('dashboard.sales-report.index') }}",
                    data: function(d) {
                        d.from_date = "{{ \Request()->input('from_date') }}";
                        d.to_date = "{{ \Request()->input('to_date') }}";
                        d.payment_method = $('.payment_method').val();
                        d.receiving_method = $('.receiving_method').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'Source',
                        name: 'Source'
                    },
                    {
                        data: 'PaymentMethod',
                        name: 'PaymentMethod'
                    },
                    {
                        data: 'Name',
                        name: 'Name'
                    },
                    {
                        data: 'Phone',
                        name: 'Phone'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'DeliveryTime',
                        name: 'DeliveryTime'
                    },
                    {
                        data: 'Total',
                        name: 'Total'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, "DESC"]
                ],

            });
            $(".payment_method").change(function() {
                table.draw();
            });
            $(".receiving_method").change(function() {
                table.draw();
            });
        });
    </script>

    <script type="text/javascript">
        $fp = flatpickr("#dateRangePicker", {
            mode: 'range',
            dateFormat: "Y-m-d",
            defaultDate: ["{{ $fromDate ?? \Request()->input('from_date') }}",
                "{{ $toDate ?? \Request()->input('to_date') }}"
            ],
            onChange: function(dates) {

                if (dates.length == 2) {

                    var start = new Date(dates[0]);
                    var end = new Date(dates[1]);
                    $start = $fp.formatDate(dates[0],
                        'Y-m-d'
                    ); //start.getFullYear()+'-'+start.getMonth()+'-'+start.getDate();// $fp.formatDate(dates[0], 'Y-m-d');

                    $end = $fp.formatDate(dates[1],
                        'Y-m-d'); //end.getFullYear()+'-'+end.getMonth()+'-'+end.getDate();

                    $('#from_date_input').val($start);
                    $('#to_date_input').val($end);

                    //auto submit if no form exists
                    if ($("#dateRangePicker").closest('form').length == 0) {
                        var url = new URL(window.location.href);


                        url.searchParams.delete("from_date");
                        url.searchParams.delete("to_date");

                        url.searchParams.append('from_date', $start);
                        url.searchParams.append('to_date', $end);
                        window.location.href = url;
                    }

                }


            }
        })
    </script>
@endsection
