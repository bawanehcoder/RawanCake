@php
$relatedProducts=app()->make(\App\Repositories\ItemRepository::class)->getRelatedProducts($product,10);
$currency=app()->make(\App\Repositories\GenralSettingRepository::class)->getCurrency();
@endphp
@if($relatedProducts && count($relatedProducts)>0 )
<div class="section-padding-03 pt-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Section Title Strat -->
                <div class="section-title">
                    <h2 class="section-title__title">@langucw('related product')</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>
        <!-- Product Active Strat -->

        <div class="product-active">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach($relatedProducts as $product)

                        <!-- Product Item Start -->
                        @include('site.home.product-type-3-widget',['product'=>$product,'quickview'=>false])

                        <!-- Product Item End -->

                    @endforeach
                </div>

                @if(getLang() == 'En')
                    <div class="swiper-button-next"><i class="lastudioicon-arrow-right"></i></div>
                    <div class="swiper-button-prev"><i class="lastudioicon-arrow-left"></i></div>
                       @else
                    <div class="swiper-button-next"><i class="lastudioicon-arrow-left"></i></div>
                    <div class="swiper-button-prev"><i class="lastudioicon-arrow-right"></i></div>
                         @endif



            </div>
        </div>
        <!-- Product Active End -->

    </div>
</div>
@endif
