@extends('site.layout.master')
@section('title')
    @langucw('address')
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}">@langucw('home')</a></li>
    <li><a href="{{ route('cart.view_cart') }}">@langucw('cart')</a></li>
    <li>@langucw('address')</li>
@endsection
@section('content')
    <div class="container mt-10">
        <div class="shop-details">
            <div class="list-cake" data-aos="fade-in">
                <div class="row">
                    @include('components.messagesAndErrors')
                    <div class="row">
                        <div class="col-12 " id="shipping_info">
                            <h1 class="section-name ">@langucw('choose your address')</h1>
                            <div class="row m-1">
                                @foreach ($shipping_info ?? [] as $index => $info)
                                    <div class="col-md-4">
                                        @include('site.cart.shipping-card-info')
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-10 mb-10">
                        <div onclick="window.open('{{ route('cart.view_cart') }}','_self');" class="btn btn-primary">
                            {{ trans('general.back') }}</div>
                        <div class="btn btn-primary" onclick="newAddressModalFun()">@langucw('add a new address')</div>
                        <div class="btn btn-primary" onclick="nextFun()"> @langucw('next')</div>
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>

        </div>
    </div>



    @include('site.cart.address-modal')
@endsection
