@php
    if(isset($id) && $id>0){
         $product=app()->make(\App\Repositories\ItemRepository::class)->findById($id);
    }
@endphp
@if($product)


<div class="swiper-slide">
    <!-- Product Item Strat -->
    <div class="product-item-style-01">
        <div class="product-item-style-01__image">
            <a href="{{route('products.show',$product)}}"><img width="270" height="270" class="d-none" src="{{asset($product->getFirstMediaUrl('products', 'medium'))}}" alt="Product"></a>
        </div>
        <ul class="product-item-style-01__meta">
            <li class="product-item-style-01__meta-action">
                <a class="shadow-1 labtn-icon-quickview" onclick="quickview({{$product->id}})" data-bs-tooltip="tooltip" data-bs-placement="top" title="@langucw('quick view')" ></a>
            </li>
            <li class="product-item-style-01__meta-action">
                <a id="favorite_{{$product->id}}" class="shadow-1 labtn-icon-wishlist @if(isLogged()){{getLogged()->hasFavorite($product)?'active':''}} @endif"  data-bs-tooltip="tooltip" data-bs-placement="top" onclick="addToFavorite({{$product->id}})" title="@langucw('add to wishlist')" ></a>
            </li>
        </ul>

        <div class="product-item-style-01__content-wrapper d-flex justify-content-between align-items-center">
            <div class="product-item-style-01__content">
                <h5 class="product-item-style-01__title"><a href="{{route('products.show',$product)}}">{{$product->getTitle()}}</a></h5>
                <div class="product-item-style-01__rating">
                    <div class="product-item-style-01__star-rating" style="width: {{$product->getPercentage()}}%;"></div>
                </div>
                <span class="product-item-style-01__price ">{{$currency}} {{$product->price()}}</span>
                @include('components.count-down',['end_time'=>$EndDate])
            </div>

        </div>
    </div>
    <!-- Product Item End -->
</div>
@endif
