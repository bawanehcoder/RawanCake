@extends('site.layout.master')
@section('title')
    @langucw('wishlist')
@endsection
@section('css') @endsection
@section('breadcrumb')
    <li ><a href="{{route('home')}}">@langucw('home')</a></li>
    <li ><a href="{{route('products.index')}}">@langucw('shop')</a></li>
    <li >@langucw('wishlist') </li>
@endsection
@section('content')

    <!-- Product Section Start -->
    <div class="shop-product-section sidebar-left overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-12 section-padding-04">
                    <!-- Shop Top Bar Start -->
                    <div class="shop-topbar">
                        <div id="current_page" class="shop-topbar-item shop-topbar-left">

                            <p>@langucw('showing') <span >{{\Request()->input('page')??0}}</span> - {{count($favorites->items())}} of {{$favorites->total()}}  @langucw('result')</p>
                        </div>
                    </div>
                    <!-- Shop Top Bar End -->
                    <!-- Product Section Start -->
                    <div id="data-container" >
                            @include('site.favorites.index-block')
                    </div>
                    <!-- Product Section End -->

                </div>
            </div>
        </div>
    </div>
    <!-- Product Section End -->


@endsection

