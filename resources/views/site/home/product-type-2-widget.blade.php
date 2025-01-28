@php
    $discount=app()->make(\App\Services\DiscountService::class)->getDiscountByItem($product);
    $endDate= app()->make(\App\Services\DiscountService::class)->getDiscountEndDateByItem($product);
    $offer=$product->offerActive->last();
@endphp
<div class="product-list-item">
    <div class="product-list-item__thumbnail">
        <a href="{{route('products.show',$product)}}"><img class="d-none"
                src="{{asset($product->getFirstMediaUrl('products', 'medium'))}}" width="270" height="270" alt="Product"></a>
        <ul class="product-list-item__meta meta-middle">
            <li class="product-list-item__meta-action"><a class="labtn-icon-quickview"
                                                          onclick="quickview({{$product->id}})"
                                                          data-bs-tooltip="tooltip" data-bs-placement="top"
                                                          title="@langucw('quick view')"></a></li>
        </ul>
    </div>
    <div class="product-list-item__info">
        <h4 class="product-list-item__title"><a href="{{route('products.show',$product)}}">{{$product->getTitle()}}</a>
        </h4>
        <span class="product-list-item__price">{{$currency}} {{$product->price()}}</span>
        <div class="product-list-item__rating">
            <div class="product-list-item__star-rating" style="width: {{$product->getPercentage()}}%;"></div>
        </div>
        <p>{{formatDescription($product->getDescription())}}...</p>
    </div>
</div>

