@extends('admin.layout.master')
@section('title')
    {{ trans('general.categories') }}
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('dashboard.main-categories.index') }}">{{ trans('general.products_categories') }}</a></li>
    <li class="breadcrumb-item active">{{ trans('general.categories') }}</li>
@endsection
@section('content')
    @include('components.messagesAndErrors')
    <div class="row">
        <!-- Small table -->
        <div class="col-md-12">
            <div class=" card table-list-card shadow">
                <div class=" card-body table-list-card-body">

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
                    <div class="table-responsive product-list">
                        <table class=" table no-footerdata-table  data-table">
                            <thead>
                                <tr>
                                    <th>{{ trans('general.id') }}</th>
                                    <th>@langucw('the image')</th>
                                    <th>@langucw('section title ar')</th>
                                    <th>@langucw('section title en')</th>
                                    <th>@langucw('ShortcutName')</th>
                                    <th>@langucw('ShortcutNameEN')</th>
                                    <th>@langucw('Visible')</th>
                                    <th style="width: 10%">{{ trans('general.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
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
                ajax: "{{ route('dashboard.main-categories.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'Name',
                        name: 'name'
                    },
                    {
                        data: 'NameEN',
                        name: 'NameEN'
                    },
                    {
                        data: 'ShortcutName',
                        name: 'ShortcutName'
                    },
                    {
                        data: 'ShortcutNameEN',
                        name: 'ShortcutNameEN'
                    },
                    {
                        data: 'Visible',
                        name: 'Visible'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className:"action-table-data"
                    },
                ],

            });
        });
    </script>
@endsection
