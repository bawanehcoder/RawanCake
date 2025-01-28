@extends('admin.layout.master')
@section('title')
    {{trans('general.sub_categories')}}
@endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.generalSetting.edit')}}">{{trans('general.products')}}</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.generalSetting.update')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="generalSetting">
            <div class=" card ">


                <div class="card-body">



                    <div class="row mt-4">
                        <div class=" col-3 ">
                            <label for="minimum_order_delivery_time">@langucw('minimum order delivery time')</label>
                            <input type="text" name="minimum_order_delivery_time" id="minimum_order_delivery_time" value="{{old('minimum_order_delivery_time')??$entity->OrderTime??''}}" class="form-control">
                        </div>
                        <div class=" col-3 ">
                            <label for="currency">@langucw('the currency')</label>
                            <select name="Currency" autocomplete="off" class="select  w-100">
                                @foreach($currencies ??[] as $currency)
                                    <option  value="{{$currency->id}}">{{$currency->Name}}  | {{$currency->Code}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" col-2 ">
                            <label for="whatsApp_number">@langucw('whatsApp number')</label>
                            <input type="text" name="whatsApp_number" id="whatsApp_number" value="{{old('whatsApp_number')??$entity->WhatsApp??''}}" class="form-control">
                        </div>
                        <div class=" col-2 ">
                            <label for="app_version">@langucw('app version')</label>
                            <input type="text" name="app_version" id="app_version" value="{{old('app_version')??$entity->AppVersion??''}}" class="form-control">
                        </div>
                        <div class="form-check   ">
                            <label class="orm-check-label pl-3" for="activate_coupons">@langucw('activate coupons')</label>
                            <div class="my-n2 mx-5">
                                <input  class="form-check-input larger" type="checkbox" @if($entity->Coupon=='effective') checked @endif name="activate_coupons" value="{{old('activate_coupons')??$entity->Coupon??''}}" id="activate_coupons">

                            </div>

                        </div>

                    </div>

                    <div class="row mt-4">

                        <div class="form-check   ">
                            <label class="orm-check-label pl-3" for="delivery_first_order">@langucw('free delivery for the first order')</label>
                            <div class="my-n2 mx-5">
                                <input  class="form-check-input larger" type="checkbox" @if($entity->DeliveryFirstOrder=='effective') checked @endif name="delivery_first_order" value="{{old('delivery_first_order')??$entity->DeliveryFirstOrder??''}}" id="delivery_first_order">

                            </div>

                        </div>
                        </div>
                        <div class="row mt-4">

                    </div>
                    <div class="row mt-4">
                        <div class=" col-6 ">
                            <label for="order_message_ar">@langucw('minimum order delivery time message') / @langucw('arabic')</label>
                            <input type="text" name="order_message_ar" id="order_message_ar" value="{{old('order_message_ar')??$entity->OrderMessage??''}}" class="form-control">
                        </div>
                        <div class=" col-6 ">
                            <label for="order_message_en">@langucw('minimum order delivery time message') / @langucw('english')</label>
                            <input type="text" name="order_message_en" id="order_message_en" value="{{old('order_message_en')??$entity->OrderMessageEN??''}}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class=" col-6 ">
                            <label for="order_completion_message_ar">@langucw('order completion message')  / @langucw('arabic')</label>
                            <textarea rows="10"  name="order_completion_message_ar"   class="form-control">{{old('order_completion_message_ar')??$entity->Thanks??''}}</textarea>
                        </div>
                        <div class=" col-6 ">
                            <label for="order_completion_message_en">@langucw('order completion message')  / @langucw('english')</label>
                            <textarea  rows="10" name="order_completion_message_en"   class="form-control rtl">{{old('order_completion_message_en')??$entity->ThanksEN??''}}</textarea>
                        </div>
                    </div>





                    <div class=" mt-4">
                        <button type="submit" class="btn btn-danger">{{trans('general.save')}}</button>
                    </div>


                </div>


            </div>

        </form>
    </section>

@endsection
@section('scripts')

    <style>

    </style>


    <script>

    </script>

@endsection
