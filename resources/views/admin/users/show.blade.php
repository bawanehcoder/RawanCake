@extends('admin.layout.master')
@section('title')
    {{trans('general.users')}}
@endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.users.index')}}">{{trans('general.users')}}</a></li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <div class="row">
        <div class="col-md-3">
            @include('components.user_overview_box')
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class=" card table-list-card>
                <div class=" card table-list-card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#dashboard"
                                                data-toggle="tab">{{trans('general.dashboard')}}</a></li>
                        <li class="nav-item"><a class="nav-link " href="#user_occation_box"
                                                data-toggle="tab">{{trans('general.user_occasion')}}</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#user_orders_box"
                                                data-toggle="tab">{{trans('general.requests')}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#user_points_box"
                                                data-toggle="tab">{{trans('general.user_points')}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#user_log_box"
                                                data-toggle="tab">{{trans('general.user_log')}}</a></li>

                    </ul>
                </div><!-- /.card-header -->
                <div class=" card-body table-list-card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="dashboard">
                            @include('components.card-dashboard')
                        </div>
                        <div class=" tab-pane" id="user_occation_box">
                            @include('components.user_occation_box')
                        </div>
                        <div class="tab-pane" id="user_orders_box">
                            @include('components.user_orders_box')
                        </div>
                        <div class="tab-pane" id="user_points_box">
                            @include('components.user_points_box')
                        </div>
                        <div class="tab-pane" id="user_log_box">
                            @include('components.user_log_box')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>

@endsection
