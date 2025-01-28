@extends('admin.layout.master')
@section('title')
    {{trans('general.create')}} {{trans('general.offers')}}
@endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{route('dashboard.offers.index')}}">{{trans('general.offers_and_discounts')}}</a></li>
    <li class="breadcrumb-item active">{{trans('general.offers')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.offers.store')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="offers">
            <div class=" card table-list-card>
                <div class=" card-body table-list-card-body">
                    <div class="form-row ">
                        <div class="form-group col-md-6 ">
                            <label for="section_title_ar">{{trans('general.products')}}</label>
                            <select name="products[]" autocomplete="off" id="products" class="form-select select2 w-100 "
                                    multiple>
                                @foreach($products ??[] as $product)
                                    <option
                                        {{ in_array($product->id, (old('products'))??[]  ) ? 'selected' : '' }} value="{{$product->id}}">{{$product->Name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-md-3">
                            <label for="BeginDate">@langucw('BeginDate')</label>
                            <x-flatpickr value="{{old('BeginDate')}}" class="form-control" name="BeginDate" show-time time-format="h:i"/>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="EndDate">@langucw('EndDate')</label>
                            <x-flatpickr value="{{old('EndDate')}}" class="form-control" name="EndDate" show-time time-format="h:i"/>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-md-3">
                            <label for="fixed_discount">@langucw('fixed discount')</label>
                            <input type="number" step="any" min="0" max="1000" name="FixedDiscount"
                                   value="{{old('FixedDiscount')}}" id="FixedDiscount" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <div class="form-check">
                                <label for="relative_discount">@langucw('relative discount')</label>
                                <input type="number" min="0" max="100" name="RelativeDiscount" placeholder="%"
                                       value="{{old('RelativeDiscount')}}" id="RelativeDiscount" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3 ">
                        <button type="submit" class="btn btn-danger">{{trans('general.save')}}</button>
                        <a href="{{route('dashboard.offers.index' )}}" class="btn btn-default">{{trans('general.back')}}</a>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
