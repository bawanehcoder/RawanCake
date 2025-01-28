@extends('admin.layout.master')
@section('title') @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.user-admin.index')}}">{{trans('general.products_categories')}}</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.user-admin.store')}}" method="POST"
              enctype="multipart/form-data">
            @csrf

            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="user-admin" >
            <div class=" card table-list-card>

                <div class=" card table-list-card-header">

                </div>
                <div class="form-row p-1">
                    <div class="form-group col-md-4">
                        <!-- Default input -->
                        <label for="name">{{trans('general.name')}}</label>
                        <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control">
                    </div>
                    <div class="form-group col-md-4 ">
                        <!-- Default input -->
                        <label for="email">@langucw('email')</label>
                        <input type="email" name="email" value="{{old('email')}}" id="email" class="form-control">
                    </div>
                     <div class="form-group col-md-4 ">
                                            <!-- Default input -->
                                            <label for="email">@langucw('password')</label>
                                            <input type="text" name="password" value="{{old('password')}}" id="password" class="form-control">

                     </div>

                </div>


                <div class="form-group col-md-3 p-1">
                <button type="submit" class="btn btn-danger">{{trans('general.save')}}</button>
                    <a class="btn btn-site" href="{{route('dashboard.user-admin.index')}}">{{trans('general.back')}}</a>
                </div>


            </div>




        </form>
    </section>

@endsection
@section('scripts') @endsection
