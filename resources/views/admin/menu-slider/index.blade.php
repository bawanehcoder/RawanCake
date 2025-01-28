@extends('admin.layout.master')
@section('title') main-categories @endsection
@section('css') @endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.menu-sliders.index')}}">@langucw('menu-sliders')</a></li>
    <li class="breadcrumb-item active">@langucw('menu-sliders')</li>
@endsection
@section('content')
    @include('components.messagesAndErrors')
    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class=" card table-list-card>
                    <div class=" card table-list-card-header border-bottom">
                        <div class="dt-action-buttons ">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('dashboard.menu-sliders.create')}}"  class="btn btn-site btn-site waves-effect waves-float waves-light">{{trans('general.create')}} </a>
                            </div>
                        </div>
                    </div>
                    <div class=" card table-list-card-datatable">
                        <table class=" table no-footerdata-table  data-table">
                            <thead>
                            <tr>
                                <th>{{trans('general.id')}}</th>
                                <th>@langucw('title')</th>
                                <th>@langucw('url')</th>
                                <th>@langucw('image')</th>
                                <th>@langucw('order')</th>
                                <th>{{trans('general.action')}}</th>
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
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.menu-sliders.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'url', name: 'url'},
                    {data: 'image', name: 'image',width:'10%'},
                    {data: 'index', name: 'index',width:'5%'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });


    </script>



@endsection
