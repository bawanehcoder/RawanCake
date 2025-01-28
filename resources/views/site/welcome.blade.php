@extends('site.layout.master')
@section('title')
@endsection
@section('css')
@endsection
@section('breadcrumb')
@endsection
@php $home='home'; @endphp
@section('content')

    @php
        $s = App\Models\Slide::all();
        $ss = App\Models\Slide::first();
        $scrolls = App\Models\Scroll::all();
    @endphp

    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($s as $item)
                <div class="carousel-item @if ($item->id == $ss->id) active @endif">
                    <img src="{{ asset($item->getFirstMediaUrl('slider', 'full')) }}" alt="...">
                    {{-- <div class="s-co">
                    <h1 class="text-center">{{ $item->title }}</h1>
                    <h2 class="text-center w-50 m-auto">{{ $item->url }}</h2>
                </div> --}}

                </div>
            @endforeach


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="bsbs" style="display: none">
        <div class="row about-section-box mt-5 d-flex flex-end align-items-end mx-0">
            @foreach ($scrolls as $item)
                <div data-aos="fade-right" class="col-md-4 col-12">
                    <div class="d-flex">
                        <div class="d-flex">
                            <div class="icon d-flex justify-content-between align-items-center">
                                <img src="{{ asset('storage/' . $item->image) }}" height="70" width="50"
                                    class="d-flex m-auto" />
                            </div>
                        </div>
                        <div class="d-flex flex-column me-2">
                            <h3>{{ \Config::get('app.locale') == 'ar' ? $item->name_ar : $item->name_en }}
                            </h3>
                            <p class="mb-0">
                                {{ \Config::get('app.locale') == 'ar' ? $item->content_ar : $item->content_en }}
                            </p>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

    <section class="hom-cats">
        @php
            $mainCategories = app()
                ->make(\App\Repositories\MainCategoriesRepository::class)
                ->get();
            // dd($mainCategories);
        @endphp

        <div class="container">
            <h1 class="section-name ">{{ __('Shop By Category') }}</h1>
            <div class="row">
                <div class="col-12 align-items-center row">
                    @foreach ($mainCategories as $item)
                        <a data-aos="fade-down" href="{{ route('products.index', $item->id) }}" class="col-md-3 col-6 mb-5">
                            <div class=" aaa item position-relative d-flex align-items-center justify-content-between ">
                                <img src="{{ $item->getFirstMediaUrl('categories', 'small') ?? '' }}" class="d-flex m-auto" />
                            </div>
                            <h3 class="mt-3 text-center">{{ $item->getName() }}</h3>
                        </a>
                    @endforeach


                </div>

            </div>
            {{-- <a href="/shop" class="btn btn-primary m-auto mt-10 vm" data-aos="zoom-in-left"
                    >{{ __('View More ...') }}</a> --}}
        </div>
    </section>


    {{-- <div class="container mt-15 animated-container">
    <img src="assets/images/offer.png" class="img-fluid mx-auto d-flex animated-image" />
</div> --}}
    @php
        $s = App\Models\Offer::first();
        // dd($s);
    @endphp
    {{-- "id" => 1
"ItemID" => 1
"BeginDate" => "2024-08-18 03:00:00"
"EndDate" => "2024-08-31 03:00:00"
"FixedDiscount" => "0.00"
"RelativeDiscount" => 30.0
"NewPrice" => "0.00"
"blob" => "offers"
"created_at" => "2024-08-28 17:08:01"
"updated_at" => "2024-08-28 17:08:01"
"deleted_at" => null --}}
    @if ($s)
        <div class="container mt-15 animated-container">
            <div class="main-wrap"><a href="{{ route('products.show', $s) }}">
                    <div class="wide-wrap">
                        <div class="top-bar" data-aos="fade-left" data-aos-delay="600"></div>
                        <div class="left-bar" data-aos="fade-up" data-aos-delay="1500"></div>
                        <h3 data-aos="fade-right" data-aos-delay="600">{{ $s->item->getTitle() }}</h3>
                        <div class="flo-ima" data-aos="fade-down" data-aos-delay="900">
                            <img
                                src="{{ asset($s->item->getFirstMediaUrl('products', 'large')) ?? '' }}?v={{ now() }}" />
                        </div>
                        @if ($s->RelativeDiscount > 0)
                            <div class="flo-label" data-aos="fade-right" data-aos-delay="1200">
                                <span class="f-title">{{ __('SPEACEIL OFFER') }}</span>
                                {{ $s->RelativeDiscount }}% {{ __('off') }}
                            </div>
                        @endif
                    </div>
                </a>
            </div>
        </div>
    @endif




    @php
        $newProducts = app()
            ->make(\App\Repositories\ItemRepository::class)
            ->getNewProducts(null,9);
    @endphp
    <header class="counter-section  parallax2" id="counter"
        style="background-image: url('assets/images/home-bg.jpg');top: 0;z-index: 111;background-blend-mode: overlay;background-color: #9E76B4;    margin-top: 0;
        z-index: 0;background-position:left;    background-attachment: fixed;">
        <div class="header-container">

            <div class="container">
                <h3 class="section-name fl" data-aos="fade-up" style="color: #d895fd;">{{ __('new products') }}</h3>
                <a href="/shop" class="btn btn-primary mt-10 cstm-btn fr" data-aos="zoom-in-left"
                    style=";margin:0">{{ __('Shop Now') }}</a>
                <div style="clear: both"></div>
                <br>

                <div class="product-content product">
                    <div class="row">
                        @php
                            $i = 0
                        @endphp
                        @foreach ($newProducts as $index => $newProduct)
                        @if ($i == 3)
                            <div class="hoder row" style="display: none">    
                        @endif
                            @php
                                $genralSetting = app()->make(\App\Repositories\GenralSettingRepository::class);

                            @endphp
                            @include('components.product', [
                                'product' => $newProduct,
                                'color' => $genralSetting->getColor($index),
                            ])
                            @php
                                $i++
                            @endphp
                            @if ($i == 9)
                            </div>    
                        @endif
                        @endforeach

                        <button type="button" id="show_more" class="btn btn-primary">{{ __('Show More') }}</button>
                        <!-- Column Tittle -->
                        {{-- <div class="col-sm-12">
                            <p class="text-content text-center">
                                Toffee sugar plum halvah liquorice <b class="purple-color">brownie gummies</b>&nbsp;chocolate
                                bar muffin candy canes.Dessert jelly-o tootsie roll jelly sesame snaps icing.
                            </p>
                        </div> --}}
                    </div>
                </div>


            </div>
        </div>
    </header>


    <div class="container mt-15 joy-section">
        <div class="row">
            <div data-aos="zoom-in-up" class="col-lg-4">
                <img src="{{ asset('rawancake.Hamada.png') }}" class="img-center" />
            </div>
            <div class="col-lg-8">
                <h3 class="section-name" data-aos="fade-up">{{ __('BRING JOY') }}</h3>
                <h6 data-aos="fade-down">{{ __('To your Children with our colourful sweets') }}</h6>
                {{-- <a href="{{ route('login') }}" class="btn btn-primary mt-10"
                    data-aos="zoom-in-left">{{ __('Become Member') }}</a> --}}
                <div class="row mt-4">
                    @php
                        $os = App\Models\Banner::all();
                    @endphp
                    @foreach ($os as $item)
                        <div data-aos="zoom-in-right" class="col-lg-6">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#videPlayer{{ $item->id }}"
                                style="text-align: start;border: 0; background-color: transparent;"
                                class="position-relative">
                                <div class=" position-absolute bg-white p-3 m-auto"
                                    style="border-radius: 50%;
                            top: 40%;
                            left: 0;
                            right: 0;
                            bottom: 40%;
                            width: 80px;
                            height: 80px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#9D78B2"
                                        class="bi bi-play-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393" />
                                    </svg>
                                </div>
                                <img src="{{ asset($item->getFirstMediaUrl('banner', 'full')) }}" alt=""
                                    class="w-100 rounded-10" />
                            </button>
                        </div>

                        <!-- Video Player -->
                        <div class="modal fade" id="videPlayer{{ $item->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="videPlayerTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 700px;">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-between bg-gray">
                                        <button type="button" class="close btn btn-default p-2" data-bs-dismiss="modal"
                                            aria-label="Close" style="border-radius: 50%; width: 40px; height: 40px;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <video width="100%" height="100%" controls>
                                            <source src="{{ asset($item->getFirstMediaUrl('videos', 'full')) }}" type="video/mp4">
                                            {{-- <source src="movie.ogg" type="video/ogg"> --}}
                                          Your browser does not support the video tag.
                                          </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Video Player -->
                    @endforeach

                    {{-- <div data-aos="zoom-in-left" class="col-lg-6">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#videPlayer"
                            style="text-align: start;border: 0; background-color: transparent;" class="position-relative">
                            <div class=" position-absolute bg-white p-3 m-auto"
                                style="border-radius: 50%;
                        top: 40%;
                        left: 0;
                        right: 0;
                        bottom: 40%;
                        width: 80px;
                        height: 80px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#9D78B2"
                                    class="bi bi-play-fill" viewBox="0 0 16 16">
                                    <path
                                        d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393" />
                                </svg>
                            </div>
                            <img src="assets/images/video-image.png" alt="" class="w-100 rounded-10" />
                        </button>
                    </div> --}}
                </div>
            </div>

        </div>
    </div>

    {{-- <a class="fixedshop" href="{{ route('mainshop') }}"><span>@langucw('Shop Now')</span></a> --}}




@endsection
@section('scripts')
@endsection
