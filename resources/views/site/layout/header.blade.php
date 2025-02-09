<!-- Header Start -->
{{-- <div class="header-section header-transparent header-sticky-03">
    <div class="container position-relative">

        <div class="row align-items-center">
            <div class="col-lg-3 col-5">
                <!-- Header Logo Start -->
                <div class="header-logo-02 m-0">
                    <a href="{{route('home')}}"><img src="{{asset('assets/img/logo_small.png')}}" width="60" height="63"
                                                     alt="Logo"></a>
                </div>
                <!-- Header Logo End -->
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <!-- Header Menu Start -->
                @include('site.layout.menu-web')
                <!-- Header Menu End -->
            </div>
            <div class="col-lg-3 col-7">
                <!-- Header Meta Start -->
                <div class="header-meta">
                    <ul class="header-meta__action header-meta__action-03 d-flex justify-content-end">
                        <li>
                            <button class="action search-open"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </li>
                        <li>
                            <button class="action" onclick="offcanvasCart()" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasCart">
                                <i class="lastudioicon-shopping-cart-2"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"
                                    id="cart_count">{{\App\Services\CartService::getCount()}}</span>
                            </button>
                        </li>
                        @if (isLogged())
                            <li class="notifactions-conatainer">
                                <button class="action  show-note">
                                    <i class="fa fa-bell"></i>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"
                                        id="notifications_count">{{getLogged()->unreadNotifications()->count()}}</span>
                                    @include('site.layout.notifications')
                                </button>
                            </li>
                        @endif
                        @if (Route::has('login'))
                            @auth
                                <li><a class="action" href="{{route('myprofile.index')}}"><i
                                            class="lastudioicon-single-01-2"></i></a></li>
                            @else
                                <li><a class="action" href="{{route('login')}}"><i class="lastudioicon-single-01-2"></i></a>
                                </li>

                            @endauth
                        @else
                        @endif
                        <li class="d-lg-none">
                            <button class="action" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"><i
                                    class="lastudioicon-menu-8-1"></i></button>
                        </li>
                    </ul>
                </div>
                <!-- Header Meta End -->
            </div>
        </div>

    </div>
</div> --}}
<!-- Header End -->
<style>
    .carousel-item img {
        width: 100%;
    }

    div#carouselExample {
        margin-top: -141px;
        /* position: absolute; */
    }

    div#carouselExample:after {
        content: no-close-quote;
    }

    .carousel-item:after {
        content: no-close-quote;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: #00000033;
    }

    div#carouselExample {
        max-height: 500px;
        overflow: hidden;
    }

    .s-co {
        position: absolute;
        top: 25%;
        left: 0%;
        right: 0;
        bottom: 0;
        z-index: 99999;
    }

    .carousel-item {
        position: relative;
    }

    .bsbs {
    background: #fff;
    position: absolute;
    bottom: -78px;
    left: 100px;
    right: 100px;
    border-radius: 36px;
    padding: 0 50px 39px;
}

.home-header::before {
    display: none;
}

header#home-header {
    height: auto !important;!i;!;
}

.slick-track h3 {
    color: #9e76b4;
    font-weight: bold;
}

.bsbs {
    box-shadow: 1px 1px 5px #0000003b;
}

.icon.d-flex.justify-content-between.align-items-center {
    background: #9e76b4;
    width: 75px;
    height: 75px;
    border-radius: 90px;
    margin-right: 15px;
}

.slick-track p {
    padding-right: 20px;
}
</style>
@if (false)
    @php
        $s = App\Models\Slide::all();
        $ss = App\Models\Slide::first();
        $scrolls = App\Models\Scroll::all();
    @endphp
    <header class=" home-header parallax" id="home-header">
        <div class="header-container">
            <nav class="navbar navbar-expand-lg navbar-dark container" id="header-container" style="top: 0; z-index: 1;">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="assets/images/logo.svg" alt="logo" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @include('site.layout.menu-web')

                        <div class="d-flex me-2">
                            @if (strtolower(getLang()) == 'en')
                                <a href="{{ route('app.change_language', ['lang' => 'ar']) }}"
                                    class="btn btn-transparent-outline mx-2 action ">
                                    <small style="    color: #9e76b4;">ع</small>

                                </a>
                            @endif
                            @if (strtolower(getLang()) == 'ar')
                                <a href="{{ route('app.change_language', ['lang' => 'en']) }}"
                                    class="btn btn-transparent-outline mx-2 action ">
                                    <small style="    color: #9e76b4;">EN</small>

                                </a>
                            @endif
                            <a href="#" class="btn btn-transparent-outline mx-2 action search-open">
                                {{-- <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.01131 12.5876C7.42293 12.7493 8.84313 12.3994 10.0157 11.6058L13.3301 14.9201C13.3301 14.9202 13.3301 14.9202 13.3301 14.9202C13.5411 15.1313 13.8272 15.2499 14.1256 15.25C14.4241 15.2501 14.7103 15.1317 14.9214 14.9207C15.1325 14.7097 15.2512 14.4236 15.2513 14.1251C15.2514 13.8267 15.1329 13.5404 14.922 13.3293L14.9219 13.3293L11.6067 10.014C12.4 8.84066 12.7492 7.41974 12.5864 6.00776C12.4149 4.5211 11.6885 3.154 10.5523 2.17996C9.41621 1.20592 7.95419 0.696786 6.45878 0.754407C4.96338 0.812027 3.54487 1.43216 2.48706 2.49073C1.42924 3.54931 0.810124 4.96826 0.753573 6.4637C0.697023 7.95915 1.20721 9.4208 2.18206 10.5562C3.15691 11.6917 4.52453 12.4172 6.01131 12.5876ZM11.2512 6.68647C11.2512 7.28569 11.1332 7.87904 10.9039 8.43265C10.6745 8.98626 10.3384 9.48928 9.91473 9.91299C9.49101 10.3367 8.98799 10.6728 8.43438 10.9021C7.88078 11.1314 7.28742 11.2495 6.6882 11.2495C6.08898 11.2495 5.49563 11.1314 4.94202 10.9021C4.38841 10.6728 3.88539 10.3367 3.46168 9.91299C3.03796 9.48928 2.70185 8.98626 2.47254 8.43265C2.24323 7.87904 2.1252 7.28569 2.1252 6.68647C2.1252 5.47628 2.60595 4.31567 3.46168 3.45994C4.3174 2.60421 5.47802 2.12347 6.6882 2.12347C7.89838 2.12347 9.059 2.60421 9.91473 3.45994C10.7705 4.31567 11.2512 5.47628 11.2512 6.68647Z"
                                        fill="white" stroke="#9E76B4" stroke-width="0.5" />
                                </svg> --}}
                                <i class="fa fa-search" aria-hidden="true"></i>

                            </a>
                            @if (isLogged())
                                <div class="dropdown show" id="profile-dropdown">

                                    <li class="notifactions-conatainer">
                                        <button class="action  show-note btn btn-transparent-outline mx-2">
                                            <i class="fa fa-bell" aria-hidden="true"></i>

                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"
                                                id="notifications_count">{{ getLogged()->unreadNotifications()->count() }}</span>
                                            @include('site.layout.notifications')
                                        </button>
                                    </li>
                                </div>
                                {{-- <a href="{{ route('myprofile.index') }}" class="action  show-note"
                                        class="btn btn-transparent-outline dropdown-toggle mx-2" role="button"
                                        id="profileButton" aria-expanded="false">
                                        <img src="{{ asset('assets/images/bell.svg') }}" />
                                    </a> --}}
                            @endif
                            <div class="dropdown show" id="profile-dropdown">

                                @auth

                                    <a href="{{ route('myprofile.index') }}"
                                        class="btn btn-transparent-outline dropdown-toggle mx-2" role="button"
                                        id="profileButton" aria-expanded="false">
                                        <i class="fa fa-user-o" aria-hidden="true"></i>

                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-transparent-outline dropdown-toggle mx-2"
                                        role="button" id="profileButton" aria-expanded="false">
                                        <i class="fa fa-user-o" aria-hidden="true"></i>

                                    </a>

                                @endauth
                            </div>
                            <div class="dropdown show" id="checkout-dropdown">
                                @php
                                $carts = \App\Services\CartService::getCarts();

                            @endphp
                            <a href="#" class="btn btn-transparent-outline dropdown-toggle mx-2"
                                role="button" id="checkoutButton" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span class="cart-count">{{ count($carts) }}</span>

                                </a>
                                <div class="dropdown-menu p-0" aria-labelledby="checkoutButton"
                                    style="width: 250px; border-radius: 10px;">
                                    <div class="p-3">
                                        @php
                                            $currency = app()
                                                ->make(\App\Repositories\GenralSettingRepository::class)
                                                ->getCurrency();
                                        @endphp
                                        {{-- <div class="row mx-0">
                                        <div class="col-lg-3">
                                            <img src="assets/images/product.png" class="img-fluid" />
                                        </div>
                                        <div class="col-lg-7 checkout-content d-flex flex-column">
                                            <h4 class="title mb-0" id="title">Mini Cake 8</h4>
                                            <span class="quntity">Quantity: <span id="quntity">1</span></span>
                                            <span class="price"><strong><span id="price">7.50</span>
                                                    JOD</strong></span>
                                        </div>
                                        <div class="col-lg-2">
                                            <img src="assets/images/ic_close.svg" class="cursor-pointer" />
                                        </div>
                                    </div> --}}
                                        <ul class="offcanvas-cart-items">
                                            @php $subtotal=0; @endphp
                                            @php
                                                $carts = \App\Services\CartService::getCarts();

                                            @endphp
                                            @foreach ($carts ?? [] as $cart)
                                                @if ($cart->item)
                                                    <li>
                                                        <!-- Mini Cart Item Start  -->
                                                        <div class="mini-cart-item">
                                                            <a onclick="deleteItem('{{ route('cart.delete', $cart) }}')"
                                                                class="mini-cart-item__remove"><i
                                                                    class="lastudioicon lastudioicon-e-remove red"></i></a>
                                                            <div class="mini-cart-item__thumbnail">
                                                                <a href="{{ route('products.show', $cart->item) }}"><img
                                                                        width="60" height="88"
                                                                        src="{{ asset($cart->item->getFirstMediaUrl('products', 'small')) }}"
                                                                        alt="Cart"></a>
                                                            </div>
                                                            @php
                                                                $price = $cart->price;
                                                                $subtotal += $price * $cart->quantity;
                                                            @endphp
                                                            <div class="mini-cart-item__content">
                                                                <h6 class="mini-cart-item__title"><a
                                                                        href="{{ route('products.show', $cart->item) }}">{{ $cart->item->getTitle() }}</a>
                                                                </h6>
                                                                <span
                                                                    class="mini-cart-item__quantity">{{ $cart->quantity }}
                                                                    × {{ $price }}</span>
                                                            </div>
                                                        </div>
                                                        <!-- Mini Cart Item End  -->
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>



                                    </div>
                                    <div class="row mx-0">

                                        <div class="total-product d-flex justify-content-between w-100 flex-row p-1 px-3 text-white"
                                            style="background-color: #BE66E3;">
                                            <div class="d-flex">
                                                {{ __('Total Price') }}
                                            </div>
                                            <div class="d-flex">
                                                <strong class="value">{{ $subtotal }}
                                                    {{ $currency }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="dropdown-item checkout-button"
                                        href="{{ route('cart.view_cart') }}">{{ __('Check Out') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </nav>
            {{-- <div class="container header-body" id="header-body">
                <div class="row d-flex justify-content-between align-items-end mx-0 ">
                    <div class="col-12">
                        <h1 class="text-center" data-aos="fade-right" data-aos-offset="300"
                            data-aos-easing="ease-in-sine">{{ $s->title }}</h1>
                        <h2 class="text-center w-50 m-auto" data-aos="fade-left" data-aos-offset="300"
                            data-aos-easing="ease-in-sine">{{ $s->url }}</h2>
                        <div class="row about-section-box mt-5 d-flex flex-end align-items-end mx-0">
                            @foreach ($scrolls as $item)
                                <div data-aos="fade-right" class="col-md-4 col-12">
                                    <div class="d-flex">
                                        <div class="d-flex">
                                            <div class="icon d-flex justify-content-between align-items-center">
                                                <img src="{{ asset($item->image) }}" height="70" width="50"
                                                    class="d-flex m-auto" />
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column me-2">
                                            <h3>{{ \Config::get('app.locale') == 'ar' ? $item->name_ar : $item->name_en }}
                                            </h3>
                                            <p class="mb-0">
                                                {{ \Config::get('app.locale') == 'ar' ? $item->content_ar : $item->content_en }}
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div> --}}


           


        </div>
    </header>
@else
    <header class=" home-header" id="home-header">
        <div class="header-container">
            <nav class="navbar navbar-expand-lg navbar-dark container" id="header-container"
                style="top: 0; z-index: 1;">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
                    </a>
                    <button class="navbar-toggler" style="color: #333" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars" aria-hidden="true"></i>

                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @include('site.layout.menu-web')

                        <div class="d-flex me-2">


                            @if (strtolower(getLang()) == 'en')
                                <a href="{{ route('app.change_language', ['lang' => 'ar']) }}"
                                    class="btn btn-transparent-outline mx-2 action flag" style="
                                    line-height: 41px;
                                    color: #915ca6;
                                        border: 1px solid #915ca6;
    padding: 4px 14px;
                                ">
                                    عربي

                                </a>
                            @endif
                            @if (strtolower(getLang()) == 'ar')
                                <a href="{{ route('app.change_language', ['lang' => 'en']) }}"
                                    class="btn btn-transparent-outline mx-2 action flag" style="
                                    line-height: 41px;
                                    color: #915ca6;
                                        border: 1px solid #915ca6;
    padding: 4px 14px;
                                ">
                                    English

                                </a>
                            @endif

                            <a href="#" class="btn btn-transparent-outline mx-2 action search-open">
                                {{-- <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.01131 12.5876C7.42293 12.7493 8.84313 12.3994 10.0157 11.6058L13.3301 14.9201C13.3301 14.9202 13.3301 14.9202 13.3301 14.9202C13.5411 15.1313 13.8272 15.2499 14.1256 15.25C14.4241 15.2501 14.7103 15.1317 14.9214 14.9207C15.1325 14.7097 15.2512 14.4236 15.2513 14.1251C15.2514 13.8267 15.1329 13.5404 14.922 13.3293L14.9219 13.3293L11.6067 10.014C12.4 8.84066 12.7492 7.41974 12.5864 6.00776C12.4149 4.5211 11.6885 3.154 10.5523 2.17996C9.41621 1.20592 7.95419 0.696786 6.45878 0.754407C4.96338 0.812027 3.54487 1.43216 2.48706 2.49073C1.42924 3.54931 0.810124 4.96826 0.753573 6.4637C0.697023 7.95915 1.20721 9.4208 2.18206 10.5562C3.15691 11.6917 4.52453 12.4172 6.01131 12.5876ZM11.2512 6.68647C11.2512 7.28569 11.1332 7.87904 10.9039 8.43265C10.6745 8.98626 10.3384 9.48928 9.91473 9.91299C9.49101 10.3367 8.98799 10.6728 8.43438 10.9021C7.88078 11.1314 7.28742 11.2495 6.6882 11.2495C6.08898 11.2495 5.49563 11.1314 4.94202 10.9021C4.38841 10.6728 3.88539 10.3367 3.46168 9.91299C3.03796 9.48928 2.70185 8.98626 2.47254 8.43265C2.24323 7.87904 2.1252 7.28569 2.1252 6.68647C2.1252 5.47628 2.60595 4.31567 3.46168 3.45994C4.3174 2.60421 5.47802 2.12347 6.6882 2.12347C7.89838 2.12347 9.059 2.60421 9.91473 3.45994C10.7705 4.31567 11.2512 5.47628 11.2512 6.68647Z"
                                        fill="white" stroke="#9E76B4" stroke-width="0.5" />
                                </svg> --}}
                                <i class="fa fa-search" aria-hidden="true"></i>

                            </a>
                            @if (isLogged())
                                <div class="dropdown show" id="profile-dropdown">

                                    <li class="notifactions-conatainer">
                                        <button class="action  show-note btn btn-transparent-outline mx-2">
                                            <i class="fa fa-bell" aria-hidden="true"></i>

                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"
                                                id="notifications_count">{{ getLogged()->unreadNotifications()->count() }}</span>
                                            @include('site.layout.notifications')
                                        </button>
                                    </li>
                                </div>
                                {{-- <a href="{{ route('myprofile.index') }}" class="action  show-note"
                                        class="btn btn-transparent-outline dropdown-toggle mx-2" role="button"
                                        id="profileButton" aria-expanded="false">
                                        <img src="{{ asset('assets/images/bell.svg') }}" />
                                    </a> --}}
                            @endif
                            <div class="dropdown show" id="profile-dropdown">

                                @auth

                                    <a href="{{ route('myprofile.index') }}"
                                        class="btn btn-transparent-outline dropdown-toggle mx-2" role="button"
                                        id="profileButton" aria-expanded="false">
                                        <i class="fa fa-user-o" aria-hidden="true"></i>

                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="btn btn-transparent-outline dropdown-toggle mx-2" role="button"
                                        id="profileButton" aria-expanded="false">
                                        <i class="fa fa-user-o" aria-hidden="true"></i>

                                    </a>

                                @endauth


                            </div>
                            <div class="dropdown show" id="checkout-dropdown">
                                @php
                                    $carts = \App\Services\CartService::getCarts();

                                @endphp
                                <a href="#" class="btn btn-transparent-outline dropdown-toggle mx-2"
                                    role="button" id="checkoutButton" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span class="cart-count">{{ count($carts) }}</span>

                                </a>
                                <div class="dropdown-menu p-0" aria-labelledby="checkoutButton"
                                    style="width: 250px; border-radius: 10px;">
                                    <div class="p-3">
                                        @php
                                            $currency = app()
                                                ->make(\App\Repositories\GenralSettingRepository::class)
                                                ->getCurrency();
                                        @endphp
                                        {{-- <div class="row mx-0">
                                        <div class="col-lg-3">
                                            <img src="assets/images/product.png" class="img-fluid" />
                                        </div>
                                        <div class="col-lg-7 checkout-content d-flex flex-column">
                                            <h4 class="title mb-0" id="title">Mini Cake 8</h4>
                                            <span class="quntity">Quantity: <span id="quntity">1</span></span>
                                            <span class="price"><strong><span id="price">7.50</span>
                                                    JOD</strong></span>
                                        </div>
                                        <div class="col-lg-2">
                                            <img src="assets/images/ic_close.svg" class="cursor-pointer" />
                                        </div>
                                    </div> --}}
                                        <ul class="offcanvas-cart-items">
                                            @php $subtotal=0; @endphp

                                            @foreach ($carts ?? [] as $cart)
                                                @if ($cart->item)
                                                    <li>
                                                        <!-- Mini Cart Item Start  -->
                                                        <div class="mini-cart-item">
                                                            <a onclick="deleteItem('{{ route('cart.delete', $cart) }}')"
                                                                class="mini-cart-item__remove"><i
                                                                    class="lastudioicon lastudioicon-e-remove red"></i></a>
                                                            <div class="mini-cart-item__thumbnail">
                                                                <a href="{{ route('products.show', $cart->item) }}"><img
                                                                        width="60" height="88"
                                                                        src="{{ asset($cart->item->getFirstMediaUrl('products', 'small')) }}"
                                                                        alt="Cart"></a>
                                                            </div>
                                                            @php
                                                                $price = $cart->price;
                                                                $subtotal += $price * $cart->quantity;
                                                            @endphp
                                                            <div class="mini-cart-item__content">
                                                                <h6 class="mini-cart-item__title"><a
                                                                        href="{{ route('products.show', $cart->item) }}">{{ $cart->item->getTitle() }}</a>
                                                                </h6>
                                                                <span
                                                                    class="mini-cart-item__quantity">{{ $cart->quantity }}
                                                                    × {{ $price }}</span>
                                                            </div>
                                                        </div>
                                                        <!-- Mini Cart Item End  -->
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>



                                    </div>
                                    <div class="row mx-0">

                                        <div class="total-product d-flex justify-content-between w-100 flex-row p-1 px-3 text-white"
                                            style="background-color: #BE66E3;">
                                            <div class="d-flex">
                                                {{ __('Total Price') }}
                                            </div>
                                            <div class="d-flex">
                                                <strong class="value">{{ $subtotal }}
                                                    {{ $currency }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="dropdown-item checkout-button"
                                        href="{{ route('cart.view_cart') }}">{{ __('Check Out') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </nav>

        </div>
    </header>
    <!-- End Header -->

@endif


<!-- End Header -->
