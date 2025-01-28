@extends('admin.layout.master')
@section('title') @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.contacts.index')}}">@langucw('informations')</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.contacts.update',$entity)}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="contacts" >
            <div class=" card table-list-card>

                <div class=" card table-list-card-header">

                </div>

                <div class="row m-2">
                    {{-- title --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('message from')</label>
                            </div>
                             <div class="col">{!! $entity->Name !!}</div>

                       </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('message content')</label>
                            </div>

                            <div class="col">
                                {!! $entity->Message !!}
                            </div>
                        </div>
                    </div>
<div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('send to')</label>
                            </div>

                            <div class="col">
                                {!! $entity->EMail !!}
                            </div>
                        </div>
                    </div>



                    {{-- english content --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('message')</label>
                            </div>
                            <div class="col-sm-9">

                                {{-- content --}}
                                <textarea   name="message" class="myeditorinstance">{!! old('message')??$entity->Replay !!}</textarea>

                            </div>
                        </div>
                    </div>



                </div>

                <div class="col-sm-9 offset-sm-3 m-2">
                    <button  {{$entity->IsReplayed==1?'disabled':''}} type="submit" class="btn btn-site">@langucw('send')</button>
                    <a href="{{route('dashboard.contacts.index')}}" class="btn btn-default">{{trans('general.back')}}</a>
                </div>
            </div>
            </div>




        </form>
    </section>

@endsection
@section('scripts')
    <x-head.tinymce-config/>
@endsection
