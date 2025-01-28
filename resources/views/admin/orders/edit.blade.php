@extends('admin.layout.master')
@section('title')
    {{ trans('general.request')}} # {{$entity->id}}
@endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{route('dashboard.product-options.index')}}">{{trans('general.requests')}}</a></li>
    <li class="breadcrumb-item active">{{ trans('general.request')}} # {{$entity->id}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="orders">
            <div class=" card table-list-card">
                <div class=" card-body table-list-card-body">
                    <div class="row m-2">
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-12 col-form-label"><label for="first-name">@langucw('order
                                        details')</label>
                                </div>
                                <div class="col-sm-3"><label> {{trans('general.name')}} : {{$entity->Name}}</label>
                                </div>
                                <div class="col-sm-3"><label>@langucw('order number') : {{$entity->id}}</label></div>
                                <div class="col-sm-3"><label> @langucw('payment method')
                                        : {{$entity->PaymentMethod}}</label></div>


                                <div class="col-sm-3"><label> @langucw('phone number') : {{$entity->Phone}}</label>
                                </div>

                                <div class="col-sm-3"><label> @langucw('delivery time')
                                        : {{__(getDayNames($entity->DeliveryTime))}}  {{$entity->DeliveryTime}} </label>
                                </div>
                                <div class="col-sm-3"><label> @langucw('add value') : <span
                                            id="AddValue">{{__($entity->AddValue)}}</span> </label></div>
                                <div class="col-sm-3">
                                    <div class="form-check">
                                        <input
                                            {{$entity->delivery_type  =='personal_pickup'?'checked':''}} class="form-check-input"
                                            value="personal_pickup" type="radio" name="flexRadioDeliveryType"
                                            id="flexRadioDeliveryType1">
                                        <label class="form-check-label" for="flexRadioDeliveryType1">
                                            @langucw('branch pickup')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            {{$entity->delivery_type  =='delivery_address'?'checked':''}} class="form-check-input"
                                            type="radio" value="delivery_address" name="flexRadioDeliveryType"
                                            id="flexRadioDeliveryType2">
                                        <label class="form-check-label" for="flexRadioDeliveryType2">
                                            @langucw('delivery address')
                                        </label>
                                    </div>


                                </div>
                                <div class="col-sm-3"></div>
                                @if($entity->delivery_type  =='personal_pickup')

                                <div class="col-sm-3">
                                    <label> @langucw('branch pickup') </label>
                                    
                                    <select autocomplete="off" id="branch_pickups" class="select w-100"
                                            name="branch_pickup_s">
                                        @foreach(\App\Models\Zones::select('*')->get() as $index=>$zone)
                                            <option
                                                {{$entity->BranchID==$zone->id?'selected':''}} value="{{$zone->id}}">{{$zone['Addres'.getLang()]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                @if($entity->delivery_type  =='delivery_address')
                                
                                <div class="col-sm-3">
                                    <label> @langucw('address') -- </label>

                                    <select autocomplete="off" id="addres" class="select w-100" name="addres">
                                        @foreach($entity->user->address as $index=>$address)
                                            <option
                                                {{$entity->ZoneID==$address->id?'selected':''}} value="{{$address->id}}">{{ $address->title .'-'. $address->address }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif


                                <div class="col-sm-3 ">
                                    <div class="form-group ">
                                        <label class=""> @langucw('other phone number') </label>
                                        <input autocomplete="off" type="text" value="{{$entity->Phone2}}"
                                               id="Phone2"
                                               class="form-control" name="Phone2">
                                    </div>
                                </div>
                                <div class="col-sm-3 " style="margin-top: 2rem">
                                    <input type="button" class="btn btn-danger" onclick="saveOtherPhone()"
                                           value="{{trans('general.save')}}">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </form>
        <div class=" card table-list-card">
            <div class=" card-header table-list-card-header">
                <div class="form-group row">
                    <label class="col-sm-2 control-label"> {{ trans('general.order_details')}}</label>
                    <label class="col-sm-2 control-label lbl-parent"
                           for="products">{{trans('general.products')}}</label>
                    <div class="col-sm-8">
                        <select name="products" autocomplete="off" id="products" class="select w-100">
                            @foreach($products ??[] as $product)
                                <option
                                    {{ in_array($product->id, (old('$products'))??[]  ) ? 'selected' : '' }} value="{{$product->id}}">{{$product->getTitle()}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="content_table" class=" card-body table-list-card-body">
                @include('components.order-edit-admin')
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                    onclick="javascript:$('#myModal').modal('hide')" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="data-container">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

    <script src="{{asset('js/btn-number.js?v=1.2')}}"></script>
    @include('components.script-input_number')
    <script>

        function saveOtherPhone() {
            $.ajax({
                url: '/dashboard/orders/change-phone2/' + {{$entity->id}},
                type: "post",
                data: {'Phone2': $('#Phone2').val()},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.status == '200') {
                        alert("@langucw('update successfully')")

                    } else if (response.status == '500') {
                        alert("@langucw('something went wrong')")
                    }
                },
                error: function (XHR, textStatus, errorThrown) {
                    alert("@langucw('an error occurred')")
                },
                complete: function (xhr, status) {
                },
            });
        }

        function deleteItemInOrder($url) {
            if (confirm('<?php echo e(__('Are you sure you want to delete this item?')); ?>')) {

                $.ajax({
                    url: $url,
                    type: "post",
                    data: '',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response, textStatus, jqXHR) {
                        if (response.status == '200') {
                            $("#AddValue").html(response.addValue);
                            $("#content_table").html(response.content);

                        } else if (response.status == '500') {
                            alert("@langucw('something went wrong')")
                        }
                    },
                    error: function (XHR, textStatus, errorThrown) {
                        alert("@langucw('an error occurred')")
                    },
                    complete: function (xhr, status) {
                    },
                });


            }
        }

        function updateItemInOrder(form_id, $url) {
            if (confirm('<?php echo e(__('Are you sure you want to update this item?')); ?>')) {

                $.ajax({
                    url: $url,
                    type: "post",
                    data: {'quantity': $("#input_number-" + form_id).val()},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response, textStatus, jqXHR) {
                        if (response.status == '200') {

                            $("#AddValue").html(response.addValue);
                            $("#content_table").html(response.content);

                        } else if (response.status == '500') {
                            alert("@langucw('something went wrong')")
                        }
                    },
                    error: function (XHR, textStatus, errorThrown) {
                        alert("@langucw('an error occurred')")
                    },
                    complete: function (xhr, status) {
                    },
                });


                //$('#form_' + form_id).submit();
            }
        }

        function getSubtotal() {
            var subtotal = 0;
            $(".total ").each(function () {
                var rowId = $(this).parent().attr('id');
                subtotal = subtotal + parseFloat($(this).html())
            });
            return parseFloat(subtotal).toFixed(2);
        }

        function getDiscount() {
            var discount = 0;
            $(".discount-item").each(function () {

                discount = ($(this).attr('discount') * $(this).attr('quantity'));

            });
            return parseFloat(discount).toFixed(2);
        }

        function getProductDetales($item) {
            $.ajax({
                url: '/dashboard/orders/get-item/' + {{$entity->id}} + "/" + `${$item}`,
                type: "get",
                data: '',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response, textStatus, jqXHR) {
                    $('#data-container').html(response);
                },
                error: function (XHR, textStatus, errorThrown) {
                    alert("@langucw('an error occurred')")
                },
                complete: function (xhr, status) {
                },
            });
        }

        $('#products').change(function () {
            $('#data-container').html('');
            getProductDetales(this.value)
            $('#myModal').modal('show');
        });


        $('input[type="radio"]').on('change', function (e) {
            $.ajax({
                url: '/dashboard/orders/change-delivery-type/' + {{$entity->id}},
                type: "get",
                data: {'type': $(this).val()},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.message == 'successfully') {
                        $("#AddValue").html(response.addValue);
                        alert("@langucw('update successfully')")
                    }
                },
                error: function (XHR, textStatus, errorThrown) {
                    alert("@langucw('an error occurred')")
                },
                complete: function (xhr, status) {
                },
            });

        });
        $('#addres').change(function () {
            $.ajax({
                url: '/dashboard/orders/change-zone/' + {{$entity->id}},
                type: "get",
                data: {'type': $(this).val()},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.message == 'successfully') {
                        alert("@langucw('update successfully')")
                    } else if (response.status == '422') {
                        alert("@langucw('The delivery method must be specified as delivery')")
                    }
                },
                error: function (XHR, textStatus, errorThrown) {
                    alert("@langucw('an error occurred')")
                },
                complete: function (xhr, status) {
                },
            });
        });
        $('#branch_pickups').change(function () {
            $.ajax({
                url: '/dashboard/orders/change-branch/' + {{$entity->id}},
                type: "get",
                data: {'type': $(this).val()},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.message == 'successfully') {
                        alert("@langucw('update successfully')")
                    } else if (response.status == '422') {
                        alert("@langucw('The delivery method must be specified as delivery')")
                    }
                },
                error: function (XHR, textStatus, errorThrown) {
                    alert("@langucw('an error occurred')")
                },
                complete: function (xhr, status) {
                },
            });
        });
    </script>
@endsection
