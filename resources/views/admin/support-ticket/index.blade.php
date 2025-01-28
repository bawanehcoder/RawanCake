@extends('admin.layout.master')
@section('title') {{trans('general.users')}} @endsection
@section('css') @endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.support-ticket.index')}}">@langucw('support-ticket')</a></li>
    <li class="breadcrumb-item active">@langucw('support-ticket')</li>
@endsection
@section('content')
<a target="_blank" href="https://app.crisp.chat/initiate/login/">goto website</a>

@endsection
@section('scripts')


@endsection
