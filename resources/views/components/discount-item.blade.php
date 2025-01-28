<div class="section-padding-02">
    <div class="container">
        @php
            $discounts=\App\Services\DiscountService::getDiscount('item');
             $currency=app()->make(\App\Repositories\GenralSettingRepository::class)->getCurrency();
        @endphp
            <!-- Product Active Strat -->
        <div class="product-active">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach($discounts??[] as $discount)
                        @foreach($discount['data'] as $id)
                            @include('components.item',['id'=>$id,'EndDate'=>$discount['EndDate']])
                        @endforeach
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
</div>

