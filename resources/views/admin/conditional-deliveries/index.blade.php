@extends('admin.layout.master')
@section('title')
    {{ trans('general.sub_categories') }}
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('dashboard.conditional-deliveries.index') }}">{{ trans('general.offers') }}</a></li>
    <li class="breadcrumb-item active">@langucw('index')</li>
@endsection
@section('content')
    @include('components.messagesAndErrors')

    <div class="page-header">
        <div class="add-item d-flex">

        </div>

        <div class="page-btn">
            <a href="{{ route('dashboard.conditional-deliveries.create') }}" class="btn btn-added"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-plus-circle me-2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>{{ trans('general.create') }}</a>
        </div>
    </div>
    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class=" card table-list-card">
                   
                    <div class=" card table-list-card-datatable">
                        <table class=" table no-footerdata-table  data-table">
                            <thead>
                                <tr>
                                    <th>{{ trans('general.id') }}</th>
                                    <th>@langucw('title')</th>
                                    <th> {{ trans('general.products') }} </th>
                                    <th>@langucw('zones')</th>
                                    <th>@langucw('start date')</th>
                                    <th>@langucw('end date')</th>
                                    <th>@langucw('delivery')</th>
                                    <th>@langucw('purchase value')</th>
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
                ajax: {
                    url: "{{ route('dashboard.conditional-deliveries.index') }}"
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'items',
                        name: 'items'
                    },
                    {
                        data: 'zone_ids',
                        name: 'zone_ids'
                    },

                    {
                        data: 'start_time',
                        name: 'start_time'
                    },
                    {
                        data: 'end_time',
                        name: 'end_time'
                    },
                    {
                        data: 'delivery',
                        name: 'delivery'
                    },
                    {
                        data: 'purchase_value',
                        name: 'purchase_value'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: "action-table-data"

                    },
                ],

            });

        });
    </script>
@endsection
