@php
    // dd($product->getFirstMediaUrl('products','large'));
@endphp
<div class="col-lg-6 offset-lg-0 col-md-10 offset-md-1">
    <!-- Product Details Image Start -->
    <div class="product-details-img d-flex overflow-hidden flex-row">
        <!-- Single Product Image Start -->
        <div class="single-product-vertical-tab swidper-container order-2">
            <div class="swipedr-wrapper" >
                <a title="{{$product->getTitle()}}" class="swiper-slide h-auto" style="padding: 10px"
                   data-bs-toggle="modal" data-bs-target="#imageModalId"
                   data-url="{{asset($product->getFirstMediaUrl('products','large'))??''}}?v={{now()}}">
                    <img class="w-100"
                         src="{{asset($product->getFirstMediaUrl('products','large'))??''}}?v={{now()}}"
                         title="{{$product->getTitle()}}" alt="{{$product->getTitle()}}">
                </a>
                @if( $product->getMedia('attached_products') )
                    @foreach (!empty('attached_products') ? $product->getMedia('attached_products') : $product->media ?? [] as $media)
                        <a class="swiper-slide h-auto"
                           href="{{asset($product->getFirstMediaUrl('products','large'))??''}}?v={{now()}}">
                            <img class="w-100" src="{{$media->getUrl('large')??''}}?v={{now()}}"
                                 title="{{$product->getTitle()}}" alt="{{$product->getTitle()}}">
                        </a>
                    @endforeach
                @endif
            </div>

            <!-- Next Previous Button Start -->
            {{-- @if(getLang() == 'En')
                <div class="swiper-button-vertical-next swiper-button-next"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                </div>
                <div class="swiper-button-vertical-prev swiper-button-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i>
                </div>
            @else

                <div class="swiper-button-vertical-prev swiper-button-prev"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                </div>
                <div class="swiper-button-vertical-next swiper-button-next"><i class="fa fa-chevron-left" aria-hidden="true"></i>
                </div>
            @endif --}}

            <!-- Next Previous Button End -->

        </div>
        <!-- Single Product Image End -->

        <!-- Single Product Thumb Start -->
        {{-- <div class="product-thumb-vertical overflow-hidden swiper-container order-1">

            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{asset($product->getFirstMediaUrl('products','small'))??''}}?v={{now()}}"
                         alt="Product">
                </div>
                @if( $product->getMedia('attached_products') )
                    @foreach (!empty('attached_products') ? $product->getMedia('attached_products') : $product->media ?? [] as $media)
                        <div class="swiper-slide">
                            <img src="{{$media->getUrl('large')??''}}?v={{now()}}" alt="Product">
                        </div>

                    @endforeach
                @endif
            </div>
        </div> --}}
        <!-- Single Product Thumb End -->

    </div>
    <!-- Product Details Image End -->
</div>


@include('site.products.image-modal')
