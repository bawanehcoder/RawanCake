@extends('site.layout.master')
@section('title') main-categories @endsection
@section('css') @endsection
@section('breadcrumb')
@endsection
@section('content')
    <!-- Start About Cake -->
    <section class="about-cake">
        <div class="container">
            <!-- About Content -->
            <h2 class="hide">
                &nbsp;
            </h2>
            <div class="about-content">
                <img alt="Cake-White" src="{{asset('site/assets/images/cake-white.png')}}">
                <p>
                    Toffee sugar plum halvah liquorice <b>brownie gummies</b>&nbsp;chocolate bar muffin candy canes.Dessert jelly-o tootsie roll jelly sesame snaps icing.
                </p>
            </div>
        </div>
    </section>
    <!-- End About Cake -->

    <!-- Start Product Cake -->
    <section class="product-cake">
        <div class="container">
            <!-- Product Tittle -->
            <div class="product-tittle">
                <img alt="Cake-Purple" src="{{asset('site/assets/images/cake-purple.png')}}">
                <h2>
                    @langucw('new products')
                </h2>
            </div>
            <!-- Product Content -->
            <div class="product-content">
                <div class="row">
                    @foreach($newProducts as $index=>$newProduct)
                    @include('components.product',['product'=>$newProduct,'color'=>$genralSetting->getColor($index)])
                    @endforeach
                    <!-- Column Tittle -->
                    <div class="col-sm-12">
                        <p class="text-content text-center">
                            Toffee sugar plum halvah liquorice <b class="purple-color">brownie gummies</b>&nbsp;chocolate bar muffin candy canes.Dessert jelly-o tootsie roll jelly sesame snaps icing.
                        </p>
                    </div>
                </div>
            </div>
        </div>

{{--        flash-sale--}}
        @include('components.flash-sale')
        <div class="pad-top-150"></div>
        {{--        Discount--}}
        @include('components.discount-item')
{{--        Conditional Deliverie--}}

        @include('components.condition-deliverie')

    </section>
    <!-- End Product Cake --><!-- Start News Cake -->
    <section class="news-cake">
        <div class="triangle-no-animate">
            &nbsp;
        </div>
        <!-- News Content -->
        <div class="new-cake-content mar-top-20">
            <!-- Tittle News Content -->
            <div class="tittle-cake text-center">
                <div class="container">
                    <img alt="Cake-White" src="{{asset('site/assets/images/cake-white.png')}}">
                    <h2>
                        New's Cake
                    </h2>
                </div>
            </div>
            <!-- Content News-->
            <div class="container mar-top-20">
                <div class="row">
                    <div class="col-sm-6 no-pad-right">
                        <div class="left-news">
                            <h1>
                                CAKE <span>Wedding</span>
                            </h1>
                        </div>
                        <div class="right-news">
                            <div class="text-table">
                                <p>
                                    <a href="shop.html"><span class="discount">40<span class="percent">%</span><br></span><span class="sale">Sale Product</span></a>
                                </p>
                            </div>
                            <div class="text-table dot-background">
                                <p>
                                    <img alt="Client" src="assets/images/client.png">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 no-pad-left">
                        <div class="top-news-right">
                            <div class="left-news-right">
                                <div class="text-table">
                                    <a class="fancybox" data-fancybox-group="contentnews" href="assets/images/ice-cream.png">
                                        <div class="wizz-effect wizz-orange">
                                            <div class="wrap-info">
                                                Ice Cream
                                            </div>
                                        </div>
                                    </a>
                                    <p>
                                        <img alt="Ice Cream" class="img-100" src="assets/images/ice-cream.png">
                                    </p>
                                </div>
                            </div>
                            <div class="right-news-right">
                                <div class="text-table">
                                    <a class="fancybox" data-fancybox-group="contentnews" href="assets/images/ice-cream-cake.png">
                                        <div class="wizz-effect wizz-green">
                                            <div class="wrap-info">
                                                Cake's Flavors
                                            </div>
                                        </div>
                                    </a>
                                    <p>
                                        <img alt="Ice Cream Cake" class="img-100" src="assets/images/ice-cream-cake.png">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-new-right">
                            <div class="quote">
                                <div>
                                    <span class="mar-right-10"><img alt="Quote" class="Quote" src="assets/images/quote.png"></span>
                                    <p>
                                        <span class="bold-font-lg">Adam Grilss, </span><span>&nbsp; CEO B </span>
                                    </p>
                                    <p>
                                        That’s great product wonderfull place and cakes, so yummy this cake.
                                    </p>
                                </div>
                                <div>
                                    <span class="mar-right-10"><img alt="Quote" class="Quote" src="assets/images/quote.png"></span>
                                    <p>
                                        <span class="bold-font-lg">Natasya, </span><span>&nbsp; CEO B </span>
                                    </p>
                                    <p>
                                        That’s great product wonderfull place and cakes, so yummy this cake.
                                    </p>
                                </div>
                                <div>
                                    <span class="mar-right-10"><img alt="Quote" class="Quote" src="assets/images/quote.png"></span>
                                    <p>
                                        <span class="bold-font-lg">Melody, </span><span>&nbsp; CEO B </span>
                                    </p>
                                    <p>
                                        That’s great product wonderfull place and cakes, so yummy this cake.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Content News-->
        </div>
        <!-- End News Content-->
    </section>
    <!-- End News Cake --><!-- Start Option Cake -->
    <section class="option">
        <!-- Tittle Option -->
        <div class="green-table pad-top-10 pad-btm-10">
            <div class="container">
                <div class="tittle-cake text-center">
                    <img alt="Cake-White" src="{{asset('site/assets/images/cake-white.png')}}">
                    <h2>
                        What We Can
                    </h2>
                </div>
            </div>
        </div>
        <div class="green-arrow"></div>
        <!-- Option Content -->
        <div class="option-content">
            <div class="container">
                <!-- Column -->
                <div class="col-sm-4">
                    <div class="messes">
                        <div class="messes-show"></div>
                        <div class="round-wrap green-option"></div>
                    </div>
                    <h4 class="green-color">
                        Make Cake
                    </h4>
                    <div class="line-temp line-green-sm">
                        &nbsp;
                    </div>
                    <p class="text-center mar-top-10">
                        Cookie apple pie donut gingerbread sweet roll pudding topping marshmallow.
                    </p>
                </div>
                <!-- Column -->
                <div class="col-sm-4">
                    <div class="messes">
                        <div class="messes-show"></div>
                        <div class="round-wrap orange-option"></div>
                    </div>
                    <h4 class="orange-color">
                        Make Cake
                    </h4>
                    <div class="line-temp line-orange-sm">
                        &nbsp;
                    </div>
                    <p class="text-center mar-top-10">
                        Cookie apple pie donut gingerbread sweet roll pudding topping marshmallow.
                    </p>
                </div>
                <!-- Column -->
                <div class="col-sm-4">
                    <div class="messes">
                        <div class="messes-show"></div>
                        <div class="round-wrap blue-option"></div>
                    </div>
                    <h4 class="blue-color">
                        Make Cake
                    </h4>
                    <div class="line-temp line-blue-sm">
                        &nbsp;
                    </div>
                    <p class="text-center mar-top-10">
                        Cookie apple pie donut gingerbread sweet roll pudding topping marshmallow.
                    </p>
                </div>
                <!-- Column -->
                <div class="col-sm-4">
                    <div class="messes">
                        <div class="messes-show"></div>
                        <div class="round-wrap pink-option"></div>
                    </div>
                    <h4 class="pink-color">
                        Make Cake
                    </h4>
                    <div class="line-temp line-pink-sm">
                        &nbsp;
                    </div>
                    <p class="text-center mar-top-10">
                        Cookie apple pie donut gingerbread sweet roll pudding topping marshmallow.
                    </p>
                </div>
                <!-- Column -->
                <div class="col-sm-4">
                    <div class="messes">
                        <div class="messes-show"></div>
                        <div class="round-wrap purple-option"></div>
                    </div>
                    <h4 class="purple-color">
                        Make Cake
                    </h4>
                    <div class="line-temp line-purple-sm">
                        &nbsp;
                    </div>
                    <p class="text-center mar-top-10">
                        Cookie apple pie donut gingerbread sweet roll pudding topping marshmallow.
                    </p>
                </div>
                <!-- Column -->
                <div class="col-sm-4">
                    <div class="messes">
                        <div class="messes-show"></div>
                        <div class="round-wrap dpurple-option"></div>
                    </div>
                    <h4 class="dpurple-color">
                        Make Cake
                    </h4>
                    <div class="line-temp line-dpurple-sm">
                        &nbsp;
                    </div>
                    <p class="text-center mar-top-10">
                        Cookie apple pie donut gingerbread sweet roll pudding topping marshmallow.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Option Cake --><!-- Start Pricing Cake -->
    <section class="pricing-cake">
        <div class="triangle-no-animate">
            &nbsp;
        </div>
        <!-- Content Pricing Cake -->
        <div class="content-pricing-cake">
            <div class="tittle-cake text-center">
                <div class="container">
                    <img alt="Cake-White" src="{{asset('site/assets/images/cake-white.png')}}">
                    <h2>
                        Our Price
                    </h2>
                </div>
            </div>
            <div class="container mar-top-20">
                <!-- Column -->
                <div class="col-sm-3 mar-btm-20">
                    <div class="img-wrap-price">
                        <img alt="Price-Purple" class="img-full-sm" src="{{asset('site/assets/images/price-purple.png')}}">
                    </div>
                    <div class="content-price content-price-tag text-center">
                        <h4 class="dpurple-color">
                            $ 100/<span>Package</span>
                        </h4>
                        <div class="price-purple">
                            <div class="triangle-no-animate">
                                &nbsp;
                            </div>
                            <div class="text-price">
                                Just Cupcakes + Free Order
                            </div>
                            <ul class="text-left list-price pad-top-0i">
                                <li class="purple-line">
                                    - 10 Cupcakes
                                </li>
                                <li class="purple-line">
                                    - Free 1 Cupcakes
                                </li>
                                <li class="purple-line">
                                    - Free Order
                                </li>
                            </ul>
                            <div class="price-btn price-purple-btn">
                                Order
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-sm-3 mar-btm-20">
                    <div class="img-wrap-price">
                        <img alt="Price-Pink" class="img-full-sm" src="{{asset('site/assets/images/price-pink.png')}}">
                    </div>
                    <div class="content-price content-price-tag text-center">
                        <h4 class="pink-color">
                            $ 200/<span>Package</span>
                        </h4>
                        <div class="price-pink">
                            <div class="triangle-no-animate">
                                &nbsp;
                            </div>
                            <div class="text-price">
                                Cupcakes + Ice Cream + Free Order
                            </div>
                            <ul class="text-left list-price pad-top-0i">
                                <li class="pink-line">
                                    - 20 Cupcakes + 5 Ice Cream
                                </li>
                                <li class="pink-line">
                                    - Free 5 Cupcakes
                                </li>
                                <li class="pink-line">
                                    - Free Order
                                </li>
                            </ul>
                            <div class="price-btn price-pink-btn">
                                Order
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-sm-3 mar-btm-20">
                    <div class="img-wrap-price">
                        <img alt="Price-Green" class="img-full-sm" src="{{asset('site/assets/images/price-green.png')}}">
                    </div>
                    <div class="content-price content-price-tag text-center">
                        <h4 class="green-color">
                            $ 300/<span>Package</span>
                        </h4>
                        <div class="price-green">
                            <div class="triangle-no-animate">
                                &nbsp;
                            </div>
                            <div class="text-price">
                                Cupcakes + Ice Cream + Cookies
                            </div>
                            <ul class="text-left list-price pad-top-0i">
                                <li class="green-line">
                                    - 25 Cupcakes + 5 Ice Cream
                                </li>
                                <li class="green-line">
                                    - Free 5 Cupcakes
                                </li>
                                <li class="green-line">
                                    - 2 Cookies Free Order
                                </li>
                            </ul>
                            <div class="price-btn price-green-btn">
                                Order
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-sm-3 mar-btm-20">
                    <div class="img-wrap-price">
                        <img alt="Price-Blue" class="img-full-sm" src="{{asset('site/assets/images/price-blue.png')}}">
                    </div>
                    <div class="content-price content-price-tag text-center">
                        <h4 class="blue-color">
                            $ 400/<span>Package</span>
                        </h4>
                        <div class="price-blue">
                            <div class="triangle-no-animate">
                                &nbsp;
                            </div>
                            <div class="text-price">
                                Special Cupcakes + Ice Cream + Cookies
                            </div>
                            <ul class="text-left list-price pad-top-0i">
                                <li class="blue-line">
                                    - 30 Special Cupcakes
                                </li>
                                <li class="blue-line">
                                    - Free 10 Cupcakes
                                </li>
                                <li class="blue-line">
                                    - 10 Ice Cream
                                </li>
                            </ul>
                            <div class="price-btn price-blue-btn">
                                Order
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="triangle-top-no-animate">
            &nbsp;
        </div>
    </section>
    <!-- End Pricing Cake --><!-- Start Team Cake -->
    <section class="abouts-cake">
        <div class="tittle-cake text-center">
            <div class="container">
                <img alt="Cake-Pink" src="{{asset('site/assets/images/cake-pink.png')}}">
                <h2 class="pink-color">
                    Our Team
                </h2>
            </div>
        </div>
        <div class="container mar-top-20">
            <!-- Column -->
            <div class="col-sm-4">
                <div class="img-round-about">
                    <img alt="About Team" class="img-100" src="{{asset('site/assets/images/about-1.png')}}">
                </div>
                <h4>
                    Katy Candy
                </h4>
                <div class="line-pink-about">
                    &nbsp;
                </div>
                <p class="text-center">
                    Cookie apple pie donut gingerbread <br>sweet roll pudding topping <br>marshmallow.
                </p>
            </div>
            <!-- Column -->
            <div class="col-sm-4">
                <div class="img-round-about">
                    <img alt="About Team" class="img-100" src="{{asset('site/assets/images/about-2.png')}}">
                </div>
                <h4>
                    Will Candy
                </h4>
                <div class="line-pink-about">
                    &nbsp;
                </div>
                <p class="text-center">
                    Cookie apple pie donut gingerbread <br>sweet roll pudding topping <br>marshmallow.
                </p>
            </div>
            <!-- Column -->
            <div class="col-sm-4">
                <div class="img-round-about">
                    <img alt="About Team" class="img-100" src="{{asset('site/assets/images/about-3.png')}}">
                </div>
                <h4>
                    Pink Candy
                </h4>
                <div class="line-pink-about">
                    &nbsp;
                </div>
                <p class="text-center">
                    Cookie apple pie donut gingerbread <br>sweet roll pudding topping <br>marshmallow.
                </p>
            </div>
        </div>
    </section>
    <!-- End Option Cake -->



@endsection
@section('scripts') @endsection
