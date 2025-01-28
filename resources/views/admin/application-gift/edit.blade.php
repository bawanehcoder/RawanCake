@extends('admin.layout.master')
@section('title')
    {{trans('general.sub_categories')}}
@endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.application-gifts.index')}}">@langucw('application
            gifts')</a></li>
    <li class="breadcrumb-item active">{{trans('general.update')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.application-gifts.update',$entity)}}"
              method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="application-gifts">
            <div class=" card table-list-card>


                <div class="form-row m-2">
                    <div class="form-group col-12 ">
                        <label for="fixed_discount">@langucw('the message')</label>
                        <textarea name="gift_message" rows="3" class="form-control">{{$entity->GiftMessage}}</textarea>
                    </div>
                    <div class="form-group col-4 ">
                        <label for="type_of_gift">@langucw('type of gift')</label>
                        <select name="type_of_gift" autocomplete="off" id="type_of_gift"
                                class="select2 type_of_gift w-100">
                            <option {{$entity->GiftType==0?'selected':''}} value="0">{{trans('general.discount_coupon')}}</option>
                            <option {{$entity->GiftType==1?'selected':''}} value="1">@langucw('product')</option>
                        </select>
                    </div>
                    <div style="display: {{$entity->GiftType==1?'none':''}} " class="form-group col-4 type-0">

                        <label for="fixed_discount">@langucw('fixed discount')</label>
                        <input type="number" step="any" min="0" max="100" name="FixedDiscount"
                               value="{{old('FixedDiscount')??$entity->FixedDiscount!=0?$entity->FixedDiscount:''}}"
                               id="FixedDiscount" class="form-control">
                    </div>
                    <div style="display: {{$entity->GiftType==1?'none':''}} " class="form-group col-4 type-0">
                        <div class="form-check">
                            <label for="relative_discount">@langucw('relative discount')</label>
                            <input type="number"  min="0" max="100" name="RelativeDiscount" placeholder="%"
                                   value="{{old('RelativeDiscount')??$entity->RelativeDiscount!=0?$entity->RelativeDiscount:''}}"
                                   id="RelativeDiscount" class="form-control">
                        </div>
                    </div>
                    <div style="display: {{$entity->GiftType==0?'none':''}} " class="form-group col-4 type-1">
                        <label for="product">@langucw('product')</label>
                        <select name="product" autocomplete="off" id="product" class="select2 type_of_gift w-100">
                            @foreach($products ??[] as $product)
                                <option {{$entity->ProductID==$product->id?'selected':''}} value="{{$product->id}}">{{$product->Name}} | {{$product->NameEN}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-4 ml-4">
                        <input class="form-check-input" type="checkbox" name="Enabled" id="Enabled"{{$entity->Enabled==1?'checked':''}} >
                        <label  class="form-check-label" for="Enabled">@langucw('activate gifts')</label>
                    </div>
                </div>


                <div class="form-group col-md-3 p-1">
                    <button type="submit" class="btn btn-danger">{{trans('general.save')}}</button>
                    <a href="{{route('dashboard.application-gifts.index')}}" class="btn btn-default">{{trans('general.back')}}</a>
                </div>


            </div>


        </form>
    </section>

@endsection
@section('scripts')
    <script>
        $('.type_of_gift').on('change', function () {
            $(".type-0").hide();
            $(".type-1").hide();
            $(".type-" + $('#type_of_gift').find(":selected").val()).show();
        });
    </script>

@endsection
