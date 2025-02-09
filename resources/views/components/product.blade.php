@if ($product)
    {{-- <div class="col mb-50">
        <!-- Product Item Start -->
        <div class="product-item text-center">
            @php $offer=$product?->offerActive->last(); @endphp
            @if ($offer)
                <div class="product-item__badge">{{ $genralSetting->getCurrency() }} {{ $product->price() }}</div>
            @endif
            @if ($discount > 0)
                <div class="product-item__badge">{{ trans('general.discount') }} {{ $discount }}</div>
            @endif

            <div class="product-item__image border w-100">
                <a href="{{ route('products.show', $product) }}"><img width="350" height="350"
                        src="{{ asset($product->getFirstMediaUrl('products', 'medium')) }}" alt="Product"></a>
                <ul class="product-item__meta">
                    <li class="product-item__meta-action">
                        <a class="shadow-1 labtn-icon-quickview" onclick="quickview({{ $product->id }})"
                            data-bs-tooltip="tooltip" data-bs-placement="top" title="@langucw('quick view')"></a>
                    </li>
                    <li class="product-item__meta-action">
                        <a class="shadow-1 labtn-icon-wishlist"
                            @if (auth()->user()) onclick="addToFavorite({{ $product->id }})" @endif
                            data-bs-tooltip="tooltip"></a>
                    </li>
                </ul>
            </div>
            <div class="product-item__content pt-5">
                <h5 class="product-item__title"><a
                        href="{{ route('products.show', $product) }}">{{ $product->getTitle() }}</a></h5>
                <span class="product-item__price">{{ $genralSetting->getCurrency() }} {{ $product->Price }}</span>

            </div>
        </div>
        <!-- Product Item End -->
    </div> --}}

    @php
        $discount = app()
            ->make(\App\Services\DiscountService::class)
            ->getDiscountByItem($product);

    @endphp

    <div data-aos="fade-down" class="d-flex flex-column col-lg-4 mb-4">
        <div class="card p-3" id="card">

            @if ($product->Special > 0)
                {{-- <div class="product-item__badge">{{ trans('general.discount') }} </div> --}}
                <div class="position-absolute Special-label" style="    left: 0;">
                    {{ __('Before 1 day') }}
                </div>
            @endif

            @if ($product->new)
                {{-- <div class="product-item__badge">{{ trans('general.discount') }} </div> --}}
                <div class="position-absolute Special-label" style="right: 0;">
                    {{ __('New') }}
                </div>
            @endif

            @if ($discount > 0)
                {{-- <div class="product-item__badge">{{ trans('general.discount') }} </div> --}}
                <div class="position-absolute offer-label">
                    {{ $discount }} %
                </div>
            @endif
            <a href="{{ route('products.show', $product) }}" class="d-flex align-items-center justify-content-between">

                <div class="d-none product-fun p-3">
                    <div class="d-flex align-items-center justify-content-between gap-2">
                        {{-- <a href="JavaScript:void(0)" class="d-flex" onclick="quickview({{ $product->id }})"
                        data-bs-tooltip="tooltip" data-bs-placement="top" title="@langucw('quick view')">>
                        <img src="{{ asset('assets/images/ic_pro_fun_zoom.svg') }}" />
                    </a>
                    <a href="#" class="d-flex"
                        @if (auth()->user()) onclick="addToFavorite({{ $product->id }})" @endif>
                        <img src="{{ asset('assets/images/ic_pro_fun_fav.svg') }}" />
                    </a>
                    <a href="JavaScript:void(0)"
                        @if (auth()->user()) onclick="addToCart({{ $product->id }})" @endif
                        class="d-flex">
                        <img src="{{ asset('assets/images/ic_pro_fun_card.svg') }}" />
                    </a>
                    <a href="#" class="d-flex"
                        @if (auth()->user()) onclick="addToCart({{ $product->id }})" @endif>
                        <img src="{{ asset('assets/images/ic_pro_fun_checkout.svg') }}" />
                    </a> --}}
                    </div>
                </div>
                @auth
                    @if ($product->isFavorite())
                        <div class="position-absolute"
                            @if (auth()->user()) onclick="addToFavorite({{ $product->id }})" @endif>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#BE66E3"
                                class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                            </svg>
                        </div>
                    @endif
                @endauth



                <img src="{{ asset($product->getFirstMediaUrl('products', 'medium')) }}" class="w-50 d-flex mx-auto"
                    id="image_1" />
            </a>

            <div class="mt-3 d-flex align-items-center justify-content-between " style="align-items: start !important">
                <a href="{{ route('products.show', $product) }}" class="d-flex align-items-center justify-content-between" style="align-items: start !important">
                    <h3 class="m-0">
                        <h3 class="mt-0">{{ $product->getTitle() }}</h3>
                    </h3>
                </a>
                @php $offer=$product?->offerActive->last(); @endphp
    
    
    
                <div class="d-flex flex-column">
                    <h3 style="    width: 95px;padding-top: 0;">{{ $product->price() }} {{ $genralSetting->getCurrency() }} </h3>
                </div>
    
            </div>
            <a href="#" class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-row ">
              
                </div>
                @if ($offer)
                    <h6 class="m-0"> {{ $product->price2() }}{{ $genralSetting->getCurrency() }}</h6>
                @endif
    
            </a>
        </div>

       

        {{-- <a href="{{ route('products.show', $product) }}" class="d-flex align-items-center justify-content-between">
            <h3 class="mt-3">{{ $product->getTitle() }}</h3>
            <div class="d-flex flex-row">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
            </div>
            <div class="d-flex">
                <h3>{{ $genralSetting->getCurrency() }} {{ $product->price() }}</h3>
            </div>
        </a> --}}
    </div>
@endif

<style>
    .position-absolute.Special-label {
    background: #9128bd;
    color: #fff;
    padding: 2px 13px;
}

div#card {}

.product .card {
    border: 1px solid #ddd;
    /* min-height: 275px; */
}

.card .mt-3.d-flex.align-items-center.justify-content-between {
    padding: 15px;
}

.card a.d-flex.align-items-center.justify-content-between:nth-child(1) {
    min-height: 150px !important;
}

.card div  a.d-flex.align-items-center.justify-content-between:nth-child(1) {
    min-height: 85px !important;
}
</style>
