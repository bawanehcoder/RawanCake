<div class="section section-margin-top section-padding-03  ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 offset-lg-0 col-md-10 offset-md-1">
                <!-- Product Details Image Start -->
                <div class="product-details-img d-flex overflow-hidden flex-row">
                    <!-- Single Product Image Start -->
                    <div class="single-product-vertical-tab swiper-container order-2">
                        <div class="swiper-wrapper ">
                            @foreach($banner->getMedia('banner') as $index=>$image)
                                <a class="swiper-slide h-auto "
                                   @if(!empty($banner->url)) href="{{$banner->url}}" @endif>
                                    <img class="" src="{{asset($image->getUrl('medium'))}}" alt="Product">
                                </a>
                            @endforeach
                        </div>
                        <!-- Next Previous Button Start -->
                        @if(getLang() == 'En')
                            <div class="swiper-button-vertical-next swiper-button-next "><i
                                    class="lastudioicon-arrow-right"></i></div>
                            <div class="swiper-button-vertical-prev swiper-button-prev"><i
                                    class="lastudioicon-arrow-left"></i></div>
                        @else
                            <div class="swiper-button-vertical-next swiper-button-next "><i
                                    class="lastudioicon-arrow-left"></i></div>
                            <div class="swiper-button-vertical-prev swiper-button-prev"><i
                                    class="lastudioicon-arrow-right"></i></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



