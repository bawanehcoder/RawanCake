@extends('admin.layout.master')
@section('title')
    {{trans('general.options')}}
@endsection
@section('css') @endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.products.index')}}">{{trans('general.products')}}</a></li>
    <li class="breadcrumb-item active">{{trans('general.options')}}</li>
@endsection

@section('content')

    @include('components.messagesAndErrors')
    <div class="row">
        <!-- Small table -->
        <div class="col-md-12">
            <form class="form form-horizontal" action="" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="custom-file-input" name="id" id="id" value="{{$entity->id}}">
                <input type="hidden" class="custom-file-input" name="blob" id="blob" value="products">
                <div class=" card table-list-card ">
                    <div class=" card table-list-card-header">
{{--                        <a href="{{route('dashboard.products-options.create',$entity)}}"--}}
{{--                           class="btn btn-success">{{trans('general.create')}} </a>--}}

                        <div style="float: right">
                            {{ $entity->Name}} | {{ $entity->NameEN }}
                        </div>
                    </div>
                    <div class=" card-body table-list-card-body">
                        <div class=" card table-list-card-datatable">
                            <table class=" table no-footerdata-table  data-table">
                                <thead>
                                <tr>
                                    <th>{{trans('general.id')}}</th>
                                    <th>{{trans('general.name')}}</th>
                                    <th>@langucw('price')</th>
{{--                                    <th>{{trans('general.action')}}</th>--}}
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('dashboard.products.options',$entity) }}"

                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'OptID', name: 'OptID'},
                    {data: 'AdditionalValue', name: 'AdditionalValue'},
                    // {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "language": {
                    "paginate": {
                        "previous": "@langucw('previous')",
                        "next": "@langucw('next')",
                        "first": "@langucw('first')",
                        "last": "@langucw('last')",
                    },
                    "search": "@langucw('search')",
                    "emptyTable": "@langucw('no data available in table')",
                    "infoEmpty": "@langucw('showing 0 to 0 of 0 entries')",
                    "info": "@langucw('showing _START_ to _END_ of _TOTAL_ entries')",
                    "lengthMenu": "Show _MENU_ entries",
                }
            });

        });

    </script>

@endsection
