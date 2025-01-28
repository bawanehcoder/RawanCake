@extends('admin.layout.master')
@section('title') @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.pages.index')}}">@langucw('informations')</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.pages.store')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="pages" >
            <div class=" card table-list-card>
                <div class=" card table-list-card-header">

                </div>

                <div class="row m-2">
                    {{-- title --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('title')</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title" value='{{ old('title') }}' placeholder="@lang('title')" />
                            </div>
                        </div>
                    </div>

                    {{-- route_name --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('page url')</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="route_name" value='{{ old('route_name') }}' placeholder="@lang('route name')" />
                            </div>
                        </div>
                    </div>

                    {{-- arabic content --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('arabic content')</label>
                            </div>
                            <div class="col-sm-9">

                                {{-- content --}}
                                <textarea name="arabic_content" class="myeditorinstance">{{old('arabic_content')}}</textarea>

                            </div>
                        </div>
                    </div>

                    {{-- english content --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('english content')</label>
                            </div>
                            <div class="col-sm-9">

                                {{-- content --}}
                                <textarea name="english_content" class="myeditorinstance">{{old('english_content')}}</textarea>

                            </div>
                        </div>
                    </div>



                </div>

                <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-site">{{trans('general.create')}}</button>

                </div>
                </div>


            </div>




        </form>
    </section>

@endsection
@section('scripts')
    <x-head.tinymce-config/>
@endsection
