@extends('admin.layout.master')
@section('title')
    {{ trans('general.users') }}
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">{{ trans('general.users') }}</a></li>
@endsection
@section('content')
    @include('components.messagesAndErrors')
    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class=" card table-list-card">
                    {{-- <div class=" card table-list-card-header ">
                        <div class="row">
                            <div class="col-md-8">
                                @include('components.date-range-input')
                            </div>
                            <div class="col-md-4">
                                <div class="btn-group">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        @langucw('filter by')
                                        @if (!empty(\Request()->input('filter_by')))
                                            : {{ __(str_replace('_', ' ', \Request()->input('filter_by'))) }}
                                        @endif
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                        <a class="dropdown-item" href="?filter_by=all">@langucw('all')</a>
                                        <a class="dropdown-item" href="?filter_by=online">@langucw('online')</a>
                                        <a class="dropdown-item" href="?filter_by=genderMale">@langucw('gender
                                                                                                                                    male')</a>
                                        <a class="dropdown-item" href="?filter_by=genderFemale">@langucw('gender
                                                                                                                                    female')</a>
                                        <a class="dropdown-item" href="?filter_by=loggingSite">@langucw('Logging in from
                                                                                                                                    site')</a>
                                        <a class="dropdown-item" href="?filter_by=loggingFacebook">@langucw('Logging in
                                                                                                                                    from
                                                                                                                                    facebook')</a>
                                        <a class="dropdown-item" href="?filter_by=loggingGoogle">@langucw('Logging in
                                                                                                                                    from
                                                                                                                                    google')</a>
                                        <a class="dropdown-item" href="?filter_by=single">@langucw('single')</a>
                                        <a class="dropdown-item" href="?filter_by=married">@langucw('married')</a>
                                        <a class="dropdown-item" href="?filter_by=birthday">@langucw('birthday')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class=" card-body table-list-card-body">
                        <table class=" table no-footerdata-table  data-table">
                            <thead>
                                <tr>
                                    <th>{{ trans('general.id') }}</th>
                                    <th>@langucw('avatar')</th>
                                    <th>{{ trans('general.name') }}</th>
                                    <th>@langucw('email')</th>
                                    <th>@langucw('phone')</th>
                                    <th>@langucw('gender')</th>
                                    <th>@langucw('online')</th>
                                    <th>@langucw('points')</th>
                                    <th>@langucw('points value')</th>
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
                ajax: {
                    url: "{{ route('dashboard.users.index', ['filter_by' => \Request()->input('filter_by')]) }}",
                    data: {
                        "from_date": "{{ \Request()->input('from_date') }}",
                        "to_date": "{{ \Request()->input('to_date') }}",
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'avatar',
                        name: 'avatar'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'LastSeenAt',
                        name: 'LastSeenAt'
                    },
                    {
                        data: 'balance',
                        name: 'balance'
                    },
                    {
                        data: 'points_value',
                        name: 'points_value'
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
                    [6, "asc"]
                ],

            });
            $(".filter_by").change(function() {
                table.draw();
            });
        });
    </script>
@endsection
