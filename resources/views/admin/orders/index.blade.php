@extends('admin.layout.master')
@section('title')
    {{ request()->query('action') == 'NewOrder' ? trans('general.requests_new') : (request()->query('action') == 'AcceptedOrder' ? trans('general.requests_accepted') : trans('general.requests_rejected')) }}
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="#">{{ trans('general.requests') }}</a>
    </li>
    <li class="breadcrumb-item active">
        {{ request()->query('action') == 'NewOrder' ? trans('general.requests_new') : (request()->query('action') == 'AcceptedOrder' ? trans('general.requests_accepted') : trans('general.requests_rejected')) }}
    </li>
@endsection
@section('content')
    @include('components.messagesAndErrors')
    <div class="col-md-12">
        <div class=" card table-list-card table-list-card">
            <div class="table-top">
                <div class="search-set">


                    <div class="search-input">
                        <a href="javascript:void(0);" class="btn btn-searchset"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg></a>

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
                            <th>@langucw('order number')</th>
                            <th>@langucw('source')</th>
                            <th>{{ trans('general.name') }}</th>
                            <th>@langucw('phone number')</th>
                            <th>@langucw('adress')</th>
                            <th>@langucw('order time')</th>
                            <th>@langucw('delivery time')</th>
                            <th>@langucw('the required amount')</th>
                            <th>{{ trans('general.action') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
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
                    url: "{{ route('dashboard.orders.index', ['action' => \Request()->input('action')]) }}",
                    data: function(d) {

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
                        data: 'Name',
                        name: 'Name'
                    },
                    {
                        data: 'Phone',
                        name: 'Phone'
                    },
                    {
                        data: 'ZoneID',
                        name: 'ZoneID'
                    },
                    {
                        data: 'OrderDate',
                        name: 'OrderDate'
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
                        searchable: false,
                        className:"action-table-data"
                    },
                ],
                order: [
                    [0, "desc"]
                ],
               
            });

        });
    </script>
@endsection
