@extends('admin.layout.master')
@section('title') @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.categories_occasions.index')}}">@langucw('categories_occasions')</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.categories_occasions.store')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="categories_occasions">
            <div class=" card table-list-card>
                <div class=" card table-list-card-header">


                    <div class="row m-2">
                        {{-- title Ar --}}
                        <div class="col-4">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="first-name">@lang('title ar')</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name_ar"
                                           value='{{ old('name_ar') }}' placeholder="@lang('title ar')"/>
                                </div>
                            </div>
                        </div>
                        {{-- title En --}}
                        <div class="col-4">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="first-name">@lang('title en')</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name_en"
                                           value='{{ old('name_en') }}' placeholder="@lang('title en')"/>
                                </div>
                            </div>
                        </div>
                        <div class=" col-4">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="section_image">@langucw('image')</label>
                                </div>

                                <div class="col-sm-9">
                                    <input type="file" class="custom-file-input" name="category_image" id="category_image" >
                                    <label class="custom-file-label" for="section_image">@langucw('choose file')</label>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
                <div class="col-3 mb-3">
                    <button type="submit" class="btn btn-site">{{trans('general.create')}}</button>
                    <a href="{{route('dashboard.categories_occasions.index')}}" class="btn btn-default">{{trans('general.back')}}</a>

                </div>
            </div>



        </form>

    </section>

@endsection
@section('scripts')

@endsection
