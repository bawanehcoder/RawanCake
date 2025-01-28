@extends('admin.layout.master')
@section('title')
    {{trans('general.update')}} {{trans('general.coupons')}}
@endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{route('dashboard.coupons.index')}}">{{trans('general.offers_and_discounts')}}</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.coupons.update',$entity)}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="coupons">
            <div class=" card  ">
                <div class=" card-body table-list-card-body ">
                    <div class="form-row ">
                        <div class="form-group col-6">
                            <label for="symbols">@langucw('symbol')</label>
                            <input type="text" value="{{old('symbols')??$entity->Serial}}" name="symbols"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-3 ">
                            <label for="fixed_discount">@langucw('fixed discount')</label>
                            <input type="number" step="any" min="0" max="1000" name="FixedDiscount"
                                   value="{{old('FixedDiscount')??$entity->FixedDiscount}}" id="FixedDiscount"
                                   class="form-control">
                        </div>
                        <div class="form-group col-3">
                            <label for="relative_discount">@langucw('relative discount')</label>
                            <input type="number" min="0" max="100" name="RelativeDiscount" placeholder="%"
                                   value="{{old('RelativeDiscount')??$entity->RelativeDiscount}}"
                                   id="RelativeDiscount" class="form-control">
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-3">
                            <label for="expiration_date">@langucw('expiration date')</label>
                            <x-flatpickr value="{{old('expiration_date')??$entity->Expiration}}"
                                         name="expiration_date" show-time time-format="h:i"/>
                        </div>
                        <div class="form-group col-3">
                            <label for="usage_limit">@langucw('usage limit')</label>
                            <input type="number" min="1" max="100000" name="usage_limit" placeholder="%"
                                   value="{{old('usage_limit')??$entity->UsedLimit}}" id="usage_limit"
                                   class="form-control">
                        </div>

                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-danger">{{trans('general.update')}}</button>
                        <a href="{{route('dashboard.coupons.index')}}"
                           class="btn btn-default">{{trans('general.back')}}</a>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </section>
@endsection
