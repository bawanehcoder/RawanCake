<div class="section-padding-02">
    <div class="container">
@php
    $discounts=\App\Services\DiscountService::getDiscount('section');
   $currency=app()->make(\App\Repositories\GenralSettingRepository::class)->getCurrency();
    @endphp
        <!-- Product Active Strat -->
        <div class="product-active">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach($discounts??[] as $discount)
                        @foreach($discount['data'] as $id)
                            @include('components.category',['id'=>$id,'EndDate'=>$discount['EndDate']])

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
@push('scripts')
    <script>
        $("img").one("load", function() {
            // do stuff
        }).each(function() {
            if(this.complete) {

                $(this).removeClass('d-none')
                $(this).load(); // For jQuery < 3.0

            }
        });

    </script>
@endpush
