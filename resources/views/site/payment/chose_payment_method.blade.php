@extends('site.layout.master')
@section('title')
    @langucw('complete the purchase process')
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}">@langucw('home')</a></li>
    <li><a href="{{ route('cart.view_cart') }}">@langucw('cart')</a></li>
    <li><a href="{{ route('payment.show_payment_form2') }}">@langucw('shipping info')</a></li>
    <li>@langucw('purchase process')</li>
@endsection
@section('content')
    @php

        $subtotal = 0;
        $discount = 0;
        $points = 0;
        $point_price = 0;
        $delivery = $entity->zone_id ?? false;
        $delivery_type = 'delivery to the address';
        $totalpoint = getLogged()->totalPoints() ?? 0;
        $special = app()
            ->make(\App\Repositories\CartRepository::class)
            ->checkIsSpecialInCart();

    @endphp


    @include('components.messagesAndErrors')
    <div class="shop-product-section section section-padding-03">
        <div class="container custom-container">
            <div class="row g-8">
                <div class="col-lg-7">
                    <!-- Billing Address Start -->
                    @include('site.payment.billing-address')

                    <!-- Billing Address End -->

                    <!-- Payment Method Start -->
                    @include('site.payment.coupon-code')
                    <!-- Payment Method End -->

                </div>
                <div class="col-lg-5">
                    <!-- Checkout Summary Start -->
                    @include('site.payment.checkout-summary')
                    <!-- Checkout Summary End -->

                    <!-- Payment Method Start -->
                    @include('site.payment.payment-method')
                    <!-- Payment Method End -->

                </div>






            </div>
        </div>
    </div>
    <form id="formMethod" action="{{ route('payment.redirect_to_payment_gateway') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="delivery_type" id="delivery_type" value="{{ $delivery_type }}">
        <input type="hidden" name="zone" id="delivery_form" value="{{ $delivery }}">
        <input type="hidden" name="delivery_price" id="delivery_price" value="{{ $delivery_price }}">
        <input type="hidden" name="points" id="points_form" value="{{ $points }}">
        <input type="hidden" name="payment_method" id="payment_method" value="">
        <input type="hidden" name="name" id="name_form" value="">
        <input type="hidden" name="branch" id="branch_form" value="">
        <input type="hidden" name="delivery_time" id="delivery_time" value="">
        <input type="hidden" name="order_date" id="order_date" value="">

        <input type="hidden" name="phone_number" id="phone_number_form" value="">
        <input type="hidden" name="notes" id="notes" value="">
        <input type="hidden" name="coupon_code" id="coupon_codee_form" value="">
        <input type="hidden" name="place" id="place_form" value="">


        <input type="hidden" name="amount" id="amount_form" value="{{ $subtotal - $discount + $delivery_price }}">
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('js/btn-number.js?v=1.2') }}"></script>
    <script>
        $(document).ready(function() {
            calc();
            $("#address").trigger("change");
            $('#address').on('change', function(e) {
                if (!$('#branch_pickup').is(':checked')) {
                    delivery($('#address').find(":selected").attr('att_prise'));
                    $('#delivery_form').val($('#address').find(":selected").val());
                }
            });
            $('#branch_pickup').change(function() {
                if ($(this).is(':checked')) {
                    delivery(0);
                } else {
                    delivery($('#address').find(":selected").attr('att_prise'));
                }
            });

            $('.input-number').change(function() {
                var id = $(this).attr('att');
                var quy = $("#input-number-" + id).val();
                $('#points_form').val(quy);
                $("#points").html(quy * 0.02);
                calc()
            });
        });

        function delivery(price) {
            $("#delivery_price").html(price);
            // calc();
        }

        function calc() {
            delivery($('#address').find(":selected").attr('att_prise'));

            var subtotal = parseFloat($("#subtotal").html());
            var delivery_price = parseFloat($("#delivery_price").html());
            console.log(delivery_price);
            var discount = parseFloat($("#discount").html());
            var points = parseFloat($("#points").html());
            var total = parseFloat(subtotal + delivery_price - discount + points).toFixed(2);
            $('#amount_form').val(total);
            $("#total").html(total);
        }

        function branchPickup() {
            if ($(".branch_pickup").is(':checked')) {
                $('#delivery_type').val('personal_pickup');
            } else {
                $('#delivery_type').val('delivery_address');
            }
            // alert( $('#delivery_type').val() );
        }

        function CompleteReques() {

            var hasError = false;

            if ($("#name_input").val() == null || $("#name_input").val().trim() === "") {
                $('#name_input').addClass('is-invalid'); // No dot here
                hasError = true;
            }


            if ($("#phone_number").val() == null || $("#phone_number").val().trim() === "") {
                $('#phone_number').addClass('is-invalid'); // No dot here
                hasError = true;
            }

            if ($("#address").val() == null || $("#address").val().trim() === "") {
                $('#address').addClass('is-invalid'); // No dot here
                hasError = true;
            }
            if ($("#delivery_date").val() == null || $("#delivery_date").val().trim() === "") {
                $('#delivery_date').addClass('is-invalid'); // No dot here
                hasError = true;
            }
            if ($("#delivery_time2").val() == null || $("#delivery_time2").val().trim() === "") {
                $('#delivery_time2').addClass('is-invalid'); // No dot here
                hasError = true;
            }
            if ($("#place").val() == null || $("#place").val().trim() === "") {
                $('#place').addClass('is-invalid'); // No dot here
                hasError = true;
            }

            if(hasError) {
                return false;
            }
            if ($("#terms_conditions").is(':checked')) {
                $('#payment_method').val($('input[name="payment-method"]:checked').val()); //
                branchPickup();
                // return;
                $('#delivery_form').val($('#address').find(":selected").val()); //
                $('#name_form').val($('#name_input').val()); //
                $('#phone_number_form').val($('#phone_number').val()); //
                $('#delivery_time').val($('#delivery_time2').val()); //
                $('#order_date').val($('#delivery_date').val());

                $('#notes').val($('#notes_textarea').val()); //
                $('#place_form').val($('#place').val()); //
                $('#branch_form').val($('#branch_pickup_s').val()); //
                $('#coupon_codee_form').val($('#coupon_code').val()); //
                $('#formMethod').submit();
            } else {
                toastr.error("@langucw('approval of the terms and conditions is required')")
            }
        }
    </script>
@endpush
