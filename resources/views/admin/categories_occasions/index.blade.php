@extends('admin.layout.master')
@section('title')
    main-categories
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories_occasions.index') }}">@langucw('categories occasions')</a></li>
    <li class="breadcrumb-item active">@langucw('categories occasions')</li>
@endsection
@section('content')
    @include('components.messagesAndErrors')
    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class=" card table-list-card">
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


                        </div>
                        <div class="search-path">

                        </div>
                        <div class="form-sort">
                        </div>
                    </div>
                <div class=" card-body table-list-card-datatable">
                    <table class=" table no-footerdata-table  data-table">
                        <thead>
                            <tr>
                                <th>{{ trans('general.id') }}</th>
                                <th>{{ trans('general.name_ar') }}</th>
                                <th>{{ trans('general.name_en') }}</th>
                                <th>@langucw('image')</th>
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
                initComplete: (settings, json) => {
                    $('.dataTables_filter').appendTo('#tableSearch');
                    $('.dataTables_filter').appendTo('.search-input');

                },
                ajax: "{{ route('dashboard.categories_occasions.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name_ar',
                        name: 'name_ar'
                    },
                    {
                        data: 'name_en',
                        name: 'name_en'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className:"action-table-data"
                    },
                ]
            });
        });
    </script>
@endsection
