
<div class="container">
    @php
        $newProducts=app()->make(\App\Repositories\ItemRepository::class)->getNewProducts(10);
        $currency=app()->make(\App\Repositories\GenralSettingRepository::class)->getCurrency();
    @endphp
        <!-- Product Active Strat -->
    <div class="product-active">
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach($newProducts??[] as $index=>$product)
                    @include('site.home.product-type-1-widget',['product'=>$product])
                @endforeach
            </div>
            @if(getLang() == 'En')
                <div class="swiper-button-next"><i class="lastudioicon-arrow-right"></i></div>
                <div class="swiper-button-prev"><i class="lastudioicon-arrow-left"></i></div>
            @else
                <div class="swiper-button-prev"><i class="lastudioicon-arrow-right"></i></div>
                <div class="swiper-button-next"><i class="lastudioicon-arrow-left"></i></div>
            @endif
        </div>
    </div>
    <!-- Product Active End -->
</div>
{{--</div>--}}
