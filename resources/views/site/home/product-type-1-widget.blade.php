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
        <div class="product-item-style-01">
            @if($discount>0)
                <div class="product-item__badge2">{{trans('general.discount')}} {{$discount}} %</div>
            @endif
            @if($offer)
                <div class="product-item__badge2">@langucw('offer') {{$product->price()}}</div>
            @endif

            <div class="product-item-style-01__image">
                <a href="{{route('products.show',$product)}}">
                    <img width="270" height="270"
                         src="{{asset($product->getFirstMediaUrl('products', 'medium'))}}"
                         alt="Product"></a>
            </div>
            <ul class="product-item-style-01__meta">
                @if(!isset($quickview) || $quickview!=false)
                    <li class="product-item-style-01__meta-action">
                        <a class="shadow-1 labtn-icon-quickview" onclick="quickview({{$product->id}})"
                           data-bs-tooltip="tooltip" data-bs-placement="top" title="@langucw('quick view')"></a>
                    </li>
                @endif
                <li class="product-item-style-01__meta-action">
                    <a id="favorite_{{$product->id}}"
                       class="shadow-1 labtn-icon-wishlist   @if(isLogged()) {{getLogged()->hasFavorite($product)?'active':''}} @endif "
                       data-bs-tooltip="tooltip" data-bs-placement="top"
                       @if(isLogged()) onclick="addToFavorite({{$product->id}})"
                       @endif title="@langucw('add to wishlist')"></a>
                </li>
            </ul>
            <div class=" d-flex justify-content-between align-items-center">
                <div class="product-item-style-01__content">
                    <h5 class="product-item-style-01__title"><a
                            href="{{route('products.show',$product)}}">{{$product->getTitle()}}</a></h5>
                    <div class="product-item-style-01__rating">
                        <div class="product-item-style-01__star-rating"
                             style="width: {{$product->getPercentage()}}%;"></div>
                    </div>
                    <span class="product-item-style-01__price ">{{$currency}} {{$product->price()}}</span>

                </div>
            </div>
        </div>
        <!-- Product Item End -->
    </div>
@endif
@push('scripts')
    <script>
        $("img").one("load", function () {
            // do stuff
        }).each(function () {
            if (this.complete) {
                $(this).removeClass('d-none')
                $(this).load(); // For jQuery < 3.0
            }
        });

    </script>
@endpush
