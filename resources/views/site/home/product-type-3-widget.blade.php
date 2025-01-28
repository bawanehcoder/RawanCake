@php

    if(isset($product)){
            $discount=app()->make(\App\Services\DiscountService::class)->getDiscountByItem($product);
            $endDate= app()->make(\App\Services\DiscountService::class)->getDiscountEndDateByItem($product);
            $offer=$product->offerActive->last();
    }

@endphp
@if(isset($discount))
    <div class="swiper-slide">
        <!-- Product Item Strat -->
        <div class="product-item text-center">
            @if($discount>0)
                <div class="product-item__badge">{{trans('general.discount')}} {{$discount}} %</div>
            @endif
            @if($offer)
                    <div class="product-item__badge">@langucw('offer')  {{$product->price()}}</div>
            @endif
            <div class="product-item__image border w-100">
                <a href="{{route('products.show',$product)}}"><img  width="270" height="270" src="{{asset($product->getFirstMediaUrl('products', 'medium'))}}" alt="Product"></a>
            <ul class="product-item__meta">
                <li class="product-item__meta-action">
                    <a id="favorite_{{$product->id}}" class="shadow-1 labtn-icon-wishlist @if(isLogged()) {{getLogged()->hasFavorite($product)?'active':''}} @endif "  data-bs-tooltip="tooltip" data-bs-placement="top" @if(isLogged()) onclick="addToFavorite({{$product->id}})" @endif title="@langucw('add to wishlist')" ></a>
                </li>
            </ul>
            </div>
            <div class="product-item__content pt-5 ">
                <h5 class="product-item__title"><a href="{{route('products.show',$product)}}">{{$product->getTitle()}}</a></h5>
                <span class="product-item__price">{{$currency}} {{$product->price()}}</span>
            </div>
        </div>
        <!-- Product Item End -->
    </div>
@endif
