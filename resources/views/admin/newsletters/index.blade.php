@extends('admin.layout.master')
@section('title')
    main-categories
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.newsletters.index') }}">@langucw('newsletters')</a></li>
    <li class="breadcrumb-item active">@langucw('the list')</li>
@endsection
@section('content')
    @include('components.messagesAndErrors')
    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class=" card table-list-card">
                    <div class=" card table-list-card-header border-bottom">
                        <div class="dt-action-buttons ">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{ route('dashboard.newsletters.export-newsletters') }}"
                                    class="btn btn-site btn-site waves-effect waves-float waves-light">@langucw('export to Excel')
                                </a>
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


                        </div>
                        <div class="search-path">

                        </div>
                        <div class="form-sort">
                        </div>
                    </div>
                    <div class=" card table-list-card-datatable">
                        <table class=" table no-footerdata-table  data-table">
                            <thead>
                                <tr>
                                    <th>{{ trans('general.id') }}</th>
                                    <th>@langucw('EMail')</th>

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
                ajax: "{{ route('dashboard.newsletters.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        width: '20%'
                    },
                    {
                        data: 'EMail',
                        name: 'EMail'
                    },
                ]
            });
        });
    </script>
@endsection
