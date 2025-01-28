@extends('site.layout.master')
@section('title')
    @langucw('cart')
@endsection
@section('css') @endsection
@section('breadcrumb')
    <li><a href="{{route('home')}}">@langucw('home')</a></li>
    <li><a href="{{route('products.index')}}">@langucw('shop')</a></li>
    <li>@langucw('cart')</li>
@endsection
@section('content')
    @php
        $subtotal_mob=0;
        $subtotal_dev=0;
        session(['intended_url' => url()->current()]);

    @endphp
    @include('components.messagesAndErrors')
    <div class="section section-padding-03">
        <div class="container mt-10 ">
            <div class="row mb-n30">
                <div class="col-lg-8 col-12 mb-30">
                    <!-- Cart Table For Tablet & Up Devices Start -->
                    @include('site.cart.tablet-up-devices')
                    <!-- Cart Table For Tablet & Up Devices End -->
                </div>
                <!-- Cart Table For Mobile Devices Start -->
                @include('site.cart.mobile-devices')
                <!-- Cart Table For Mobile Devices End -->

                <!-- Cart Totals Start -->
                @include('site.cart.cart-totals')
                <!-- Cart Totals End -->
            </div>
        </div>
    </div>

@endsection
@section('style') @endsection
@push('scripts')
    <script src="{{asset('js/btn-number.js?v=1.2')}}"></script>
    <script>
        $('.input-number').change(function () {
            let id = $(this).attr('att');
            let quy = $("#input-number-" + id).val();
            let price = $(".price-" + id).html();
            let itemTotal = (quy * price).toFixed(2);
            $(".total_" + id).html(itemTotal);
            $(".subtotal_amount").html(getSubtotal());
        });

        function getSubtotal() {
            let subtotal = 0;
            $("#table td .total ").each(function () {
                subtotal += parseFloat($(this).html())
            });
            return subtotal.toFixed(2);
        }

        function nextRoute(Url) {
            let _data = new Array();

            $(".input-number").each(function () {
                var rowId = $(this).attr('att');
                var id = $("#input-number-" + rowId).val();
                _data.push({"id": rowId, "num": id});
            });

            $.ajax({
                type: 'GET',
                url: Url,
                data: {data: JSON.stringify(_data)},
                // dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {

                },
                success: function (response) {
                    console.log(response);
                    // return;
                    if (response.status == 200) {
                        window.location = '{{Route('payment.show_payment_form2')}}';
                    }
                },
                complete: function (response) {

                },
                error: function (xhr, status, error) {
                    if (xhr.responseJSON.message != undefined && xhr.responseJSON.message != null) {
                        toastr.error(xhr.responseJSON.message)
                    } else {
                        toastr.error("@langucw('an error occurred')")
                    }
                }
            });
        }
    </script>
@endpush
