@extends('admin.layout.master')
@section('title') @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.occasions.index')}}">@langucw('occasions')</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.occasions.store')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="occasions">
            <div class=" card table-list-card>
                <div class=" card table-list-card-header">


                    <div class="row m-2">
                        {{-- title Ar --}}
                        <div class="col-6">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="first-name">@lang('title ar')</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="title_ar"
                                           value='{{ old('title_ar') }}' placeholder="@lang('title ar')"/>
                                </div>
                            </div>
                        </div>
                        {{-- title En --}}
                        <div class="col-6">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="first-name">@lang('title en')</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="title_en"
                                           value='{{ old('title_en') }}' placeholder="@lang('title en')"/>
                                </div>
                            </div>
                        </div>
                        {{-- description ar --}}
                        <div class="col-6">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="first-name">@lang('description ar')</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" name="description_ar"

                                              placeholder="@lang('description ar')">{{ old('description_ar') }}</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- description en --}}
                        <div class="col-6">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="first-name">@lang('description en')</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea  class="form-control" name="description_en"

                                              placeholder="@lang('description en')">{{ old('description_en') }}</textarea>
                                </div>
                            </div>
                        </div>
                        {{--                        date--}}
                        <div class="col-6">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="first-name">@lang('date')</label>
                                </div>
                                <div class="col-sm-9">
                                    <x-flatpickr value="{{old('date')}}" name="date"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <button type="submit" class="btn btn-site">{{trans('general.create')}}</button>
                    <a href="{{route('dashboard.occasions.index')}}" class="btn btn-default">{{trans('general.back')}}</a>

                </div>
            </div>



        </form>

    </section>

@endsection
@section('scripts')

@endsection
