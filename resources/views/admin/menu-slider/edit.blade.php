@extends('admin.layout.master')
@section('title') @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.menu-sliders.index')}}">@langucw('menu-sliders')</a></li>
    <li class="breadcrumb-item active">@langucw('edit')</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.menu-sliders.update',$entity)}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="menu-sliders" >
            <input type="hidden" class="custom-file-input" name="id" id="id" value="{{$entity->id}}" >

            <div class=" card table-list-card ">



                <div class="row m-4">
                    {{-- title --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-3 col-form-label">
                                <label for="first-name">@lang('title')</label>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control " name="title" value='{{ old('title')??$entity->title }}' placeholder="@lang('title')" />
                            </div>
                        </div>
                    </div>

                    {{-- url --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-3 col-form-label">
                                <label for="first-name">@lang('url')</label>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" name="url" value='{{ old('url')??$entity->url }}' placeholder="@lang('url')" />
                            </div>
                        </div>
                    </div>
                    {{-- index --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-3 col-form-label">
                                <label for="first-name">@lang('order')</label>
                            </div>
                            <div class="col-9">
                                <input type="number" min="0" max="100" class="form-control" name="order" value='{{ old('order')??$entity->index }}' placeholder="@lang('order')" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12">

                        <div class="form-group row">
                            <div class="col-3 col-form-label">
                                <label for="attached_image">@langucw('the attached image')</label>
                            </div>
                            <div class="custom-file col-8 ml-3 mr-3">
                                <input type="file" class="custom-file-input  " name="image" id="image" >
                                <label class="custom-file-label  " for="slider">@langucw('choose file')</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9 offset-sm-3 ">
                <div class="form-group ">
                   <a href="{{asset($entity->getFirstMediaUrl('slider','large'))}}" target="_blank"><img  src="{{asset($entity->getFirstMediaUrl('slider','small'))??''}}?v={{now()}}" class="img-thumbnail"></a>
                </div>
                </div>
                <div class="col-sm-9 offset-sm-3 mb-3">
                    <button type="submit" class="btn btn-danger">{{trans('general.update')}}</button>
                    <a href="{{route('dashboard.menu-sliders.index')}}" class="btn btn-default">{{trans('general.back')}}</a>
                </div>
            </div>
            </div>
        </form>
    </section>

@endsection
@section('scripts')

@endsection
