@extends('admin.layout.master')
@section('title')
    {{trans('general.update')}} {{trans('general.options')}}
@endsection
@section('css') @endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.products.index')}}">{{trans('general.products')}}</a></li>
    <li class="breadcrumb-item active">{{trans('general.options')}}</li>
@endsection

@section('content')

    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.products-options.update',$entity)}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="id" id="id" value="{{$entity->id}}">
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="products-options">
            <div class=" card table-list-card>
                <div class=" card-body table-list-card-body">
                    <div class="form-group col-md-6 p-1">
                        <label for="short_title_en">{{trans('general.name')}}</label>

                        <select id="MainID" name="MainID" autocomplete="off" class="custom-select">
                            @foreach($options ??[] as $option)
                                <option
                                    {{$option->id==$entity->subOption->itemOption->id? 'selected' :''}}   onclick="getSubOptions({{$option->id}})"
                                    value="{{$option->id}}">{{$option->Name}} | {{$option->NameEN}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row p-1">

                        <div class="form-group col-md-6 p-1">
                            <label for="short_title_en">{{trans('general.name')}}</label>

                            <select name="OptID" id="OptID" autocomplete="off" class="custom-select">
                                @if($options??[] && count($options)>0)
                                    @foreach($entity->subOption->itemOption->subOption ??[] as $option)
                                        <option
                                            {{$option->id==$entity->OptID? 'selected' :''}}  value="{{$option->id}}">{{$option->Name}}
                                            | {{$option->NameEN}} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <!-- Default input -->
                            <label for="description_ar">{{trans('general.additional_amount')}}</label>
                            <input type="number" step="any" min="0" max="1000" name="AdditionalValue"
                                   value="{{old('AdditionalValue')??$entity->AdditionalValue}}" id="AdditionalValue"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3 p-1">
                    <button type="submit" class="btn btn-danger">{{trans('general.update')}}</button>
                    <a href="{{route('dashboard.products.options',$entity->ItemID)}}"
                       class="btn btn-default">{{trans('general.back')}}</a>
                </div>
            </div>
        </form>
    </section>

@endsection
@section('scripts')
    <script src="{{asset('js/get_subOption_by_parent.js')}}"></script>
@endsection
