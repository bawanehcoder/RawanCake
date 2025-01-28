@php
    $bestSellers=app()->make(\App\Repositories\ItemRepository::class)->getBestSellersProducts(3);
    $currency=app()->make(\App\Repositories\GenralSettingRepository::class)->getCurrency();
@endphp
<div class="product-list">
    <h3 class="product-list__title">@langucw('best sellers')</h3>
    <div class="product-list__wrapper">
        @foreach($bestSellers??[] as $index=>$product)
            @include('site.home.product-type-2-widget')
        @endforeach
    </div>
</div>
