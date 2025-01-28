@extends('admin.layout.master')
@section('title') @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.branches.index')}}">@langucw('informations')</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.branches.store')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="branches" >
            <div class=" card table-list-card>
                <div class=" card table-list-card-header">

                </div>

                <div class="row m-2">
                    {{-- AddresAr --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('AddresAr')</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="AddresAr" value='{{ old('AddresAr') }}' placeholder="@lang('AddresAr')" />
                            </div>
                        </div>
                    </div>
                    {{-- AddresEn --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('AddresEn')</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="AddresEn" value='{{ old('AddresEn') }}' placeholder="@lang('AddresEn')" />
                            </div>
                        </div>
                    </div>
                    {{-- Phone --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('Phone')</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text"  class="form-control" name="Phone" value='{{ old('Phone') }}' placeholder="@lang('Phone')" />
                            </div>
                        </div>
                    </div>
                    {{-- Map --}}
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('Map')</label>
                            </div>
                            <div class="col-sm-9">
                                <textarea  class="form-control" name="Map" >{{ old('Map') }}</textarea>
                            </div>
                        </div>
                    </div>





                </div>

                <div class="col-sm-9 offset-sm-3 mb-3">
                <button type="submit" class="btn btn-site">{{trans('general.create')}}</button>

                </div>
                </div>


            </div>




        </form>
    </section>

@endsection
@section('scripts')

@endsection
