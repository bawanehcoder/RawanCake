@extends('admin.layout.master')
@section('title')
    main-categories
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.zones.index') }}">@langucw('informations')</a></li>
    <li class="breadcrumb-item active">@langucw('pages')</li>
@endsection
@section('content')
    @include('components.messagesAndErrors')

    <div class="page-header">
        <div class="add-item d-flex">

        </div>

        <div class="page-btn">
            <a href="{{ route('dashboard.zones.create') }}" class="btn btn-added"><svg xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle me-2">
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

                    <div class=" card-body table-list-card-datatable">
                        <table class=" table no-footerdata-table  data-table">
                            <thead>
                                <tr>
                                    <th>{{ trans('general.id') }}</th>
                                    <th>@langucw('AddresAr')</th>
                                    <th>@langucw('AddresEn')</th>
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
                ajax: "{{ route('dashboard.zones.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'AddresAr',
                        name: 'AddresAr'
                    },
                    {
                        data: 'AddresEn',
                        name: 'AddresEn'
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
