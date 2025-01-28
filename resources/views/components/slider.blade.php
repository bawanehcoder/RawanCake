@php  $verastion=\Config::get('core.setting.verastion','0'); @endphp

<div class="slider-section slider-active overflow-hidden" style="height: 610px;">
    <div class="swiper">
        <div class="swiper-wrapper">
            @php $sliders=\App\Models\Slide::all()??[]; @endphp
            @foreach($sliders as $index=>$slider )
                <!-- Single Slider Start -->
                <div class="swiper-slide single-slider-04 animation-style-04"
                     style="background-image: url({{asset('site/bakerfresh/assets/images/slider/slider-4-01.jpg')}}?v={{ $verastion}});">
                    <div class="container">
                        <!-- Slider Content Start -->
                        <div class="slider-content-04">
                            <h1 class="slider-content-04__title text-white">{{$slider->title}}</h1>
                            <a class=" btn btn-primary rounded-pill @if(empty($slider->url)) invisible @endif"
                               href="{{$slider->url}}">@langucw('view')</a>

                        </div>
                        <!-- Slider Content Start -->

                        <!-- Slider Images Start -->
                        <div class="slider-images-02">
                            <div class="slider-images-02__image mx-auto">
                                <img src="{{asset($slider->getFirstMediaUrl('slider', 'medium'))}}"
                                     alt="Slider Product">
                            </div>
                        </div>
                        <!-- Slider Images Start -->
                    </div>
                </div>
                <!-- Single Slider End -->
            @endforeach

        </div>
        <div class="slider-arrow slider-arrow-four">
            @if(getLang() == 'En')
                <div class="swiper-button-next"><i class="lastudioicon-left-arrow"></i></div>
                <div class="swiper-button-prev"><i class="lastudioicon-right-arrow"></i></div>
            @else
                <div class="swiper-button-prev"><i class="lastudioicon-right-arrow"></i></div>
                <div class="swiper-button-next"><i class="lastudioicon-left-arrow"></i></div>
            @endif
        </div>
    </div>
</div>


