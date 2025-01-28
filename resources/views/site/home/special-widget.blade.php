@php
    $special=app()->make(\App\Repositories\ItemRepository::class)->getSpecialProducts(3);
    $currency=app()->make(\App\Repositories\GenralSettingRepository::class)->getCurrency();
@endphp
<div class="product-list">
    <h3 class="product-list__title">@langucw('special requests')</h3>
    <div class="product-list__wrapper">
        @foreach($special??[] as $index=>$product)
            @include('site.home.product-type-2-widget')
        @endforeach
    </div>
</div>
