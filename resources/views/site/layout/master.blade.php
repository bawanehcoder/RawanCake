<!DOCTYPE html>
<html class="no-js" lang="{{ \Config::get('app.locale') == 'en' ? 'en' : 'ar' }}"
    dir="{{ \Config::get('app.locale') == 'en' ? 'ltr' : 'rtl' }}">

<head>
    @php  $verastion=\Config::get('setting.verastion'); @endphp
    @include('site.layout.head')
    @include('components.head-script')
    @include('site.layout.search')
</head>

<body>
    <form style='display: none;' id='delete-form' action="" method="post">
        @csrf
        <input type="hidden" name="_method" value="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    @include('components.offcanvas-cart')
    @include('site.layout.header')


    @yield('content')

    @include('site.layout.footer')

    @include('site.layout.footer-scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
    <script src="assets/js/home.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            disable: 'mobile'
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const elements = document.querySelectorAll('.joy-section img, .joy-section .btn-primary');

            elements.forEach(el => {
                el.style.opacity = 0;
                el.style.transition = 'opacity 1s ease-in-out';
            });

            window.addEventListener('scroll', () => {
                elements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    if (rect.top <= window.innerHeight && rect.bottom >= 0) {
                        el.style.opacity = 1;
                    }
                });
            });
        });
    </script>

    @php
        $carts = \App\Services\CartService::getCarts();
    @endphp

    <!-- Update the cart section to show count only when > 0 -->
    @if (count($carts) > 0)
        <a class="fixedshop tow" href="{{ route('cart.view_cart') }}">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span class="cart-count2">{{ count($carts) }}</span>
        </a>
    @else
        <a class="fixedshop tow" href="{{ route('cart.view_cart') }}">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span class="cart-count2" style="display: none;"></span> <!-- Hide the cart count if empty -->
        </a>
    @endif

    <style>
        a.fixedshop.tow {
            right: auto;
            left: 20px;
            border: 2px solid #fff;
        }

        span.cart-count2 {
            background: #F44336;
            width: 40px;
            height: 40px;
            display: block;
            line-height: normal;
            color: #fff;
            position: absolute;
            top: -5px;
            right: -5px;
            line-height: 40px;
            border-radius: 90px;
        }

        @media only screen and (min-width: 767px) {
            a.fixedshop.tow {
                display: none;
            }
        }

        @media only screen and (max-width: 767px) {
            .desktop-t {
                display: none
            }
        }

        .product .card img {
            min-height: 164px;
            max-height: 164px;
        }
        .product .card img {
    min-height: 164px;
    max-height: 164px;
    width: auto !important;
   max-width: 50% !important;
}
    </style>

</body>

</html>
