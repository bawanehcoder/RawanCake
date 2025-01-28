@extends('admin.layout.master')
@section('title') @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.user-admin.index')}}">@langucw('departments and
            products')</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="" method="POST"
              enctype="multipart/form-data">
            @csrf

            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="user-admin">
            <input type="hidden" class="custom-file-input" name="id" id="id" value="{{$entity->id}}">
            <div class=" card table-list-card>

                <div class=" card table-list-card-header">

                </div>
                <div class="form-row p-1">
                    <div class="form-group col-md-4">
                        <!-- Default input -->
                        <label for="name">{{trans('general.name')}}</label>
                        <input disabled type="text" name="name" value="{{old('name')??$entity->name}}" id="name"
                               class="form-control">
                    </div>
                    <div class="form-group col-md-4 ">
                        <!-- Default input -->
                        <label  for="email">@langucw('email')</label>
                        <input disabled type="email" name="email" value="{{old('email')??$entity->email}}" id="email"
                               class="form-control">
                    </div>
                    <div class="form-group col-md-4 ">
                        <!-- Default input -->
                        <label for="email">@langucw('password')</label>
                        <input disabled type="text" name="password" value="{{old('password')}}" id="password"
                               class="form-control">

                    </div>

                </div>

                <div class="form-group col-md-3 p-1">

                    <a class="btn btn-site" href="{{route('dashboard.user-admin.index')}}">{{trans('general.back')}}</a>
                </div>
            </div>
        </form>
    </section>

@endsection
@section('scripts') @endsection
