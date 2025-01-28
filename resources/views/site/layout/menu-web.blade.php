<ul class="navbar-nav m-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a href="{{route('home')}}" class="nav-link @if(request()->routeIs('home')) active @endif"><span>@langucw('home')</span></a>
    </li>
    <li class="nav-item ">
        <a class="nav-link @if(request()->routeIs('mainshop')) active @endif" href="{{ route('mainshop') }}"><span>@langucw('shop')</span></a>

        {{-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div class="row">
                @foreach(\App\Models\Category::where('CatID','0')->get() as $cat)
                    <div class="col-xs-6 col-sm-4 col-md-3"><ul><li><a class="sub-item-link" href="{{route('products.index',[$cat->id])}}"><span >{{$cat->getName()}}</span></a></li></ul></div>
                @endforeach
            </div>
        </div> --}}
    </li>

    
    <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('page.show')) active @endif" href="{{route('page.show', ['routeName' => 'about'])}}"><span>@langucw('about Us')</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('contact_us.show')) active @endif" href="{{route('contact_us.show')}}"><span>@langucw('contact Us')</span></a>
    </li>
</ul>


{{-- <div class="header-menu d-flex justify-content-center">
    <ul class="header-primary-menu header-primary-menu-04 px-5 shadow bg-white rounded-pill d-flex justify-content-center">
        <li>
            <a href="{{route('home')}}" class="menu-item-link active"><span>@langucw('home')</span></a>
        </li>
        <li class="position-static">
            <a class="menu-item-link" href="#"><span>@langucw('shop')</span></a>
            <div class="sub-menu sub-menu-mega  ">
                <div class="row">
                    @foreach(\App\Models\Category::where('CatID','0')->get() as $cat)
                        <div class="col-xs-6 col-sm-4 col-md-3"><ul><li><a class="sub-item-link" href="{{route('products.index',[$cat->id])}}"><span >{{$cat->getName()}}</span></a></li></ul></div>
                    @endforeach
                </div>
            </div>
        </li> --}}
{{--        <li><a class="menu-item-link" href="#"><span>@langucw('pages')</span></a>--}}
{{--            <ul class="sub-menu">--}}
{{--                <li><a class="sub-item-link" href="{{route('favorites.index')}}"><span>@langucw('wishlist')</span></a>--}}
{{--                </li>--}}
{{--                <li><a class="sub-item-link" href="{{route('contact_us.show')}}"><span>@langucw('contact')</span></a>--}}
{{--                </li>--}}
{{--                <li><a class="sub-item-link"--}}
{{--                       href="{{route('page.show', ['routeName' => 'about'])}}"><span>@langucw('about')</span></a>--}}
{{--                </li>--}}
{{--                <li><a class="sub-item-link"--}}
{{--                       href="{{route('page.show', ['routeName' => 'termsAndConditions'])}}"><span>@langucw('terms and conditions')</span></a>--}}
{{--                </li>--}}
{{--                <li><a class="sub-item-link" href="{{route('page.show', ['routeName' => 'ourStory'])}}"><span>@langucw('our story')</span></a>--}}
{{--                </li>--}}
{{--                <li><a class="sub-item-link"--}}
{{--                       href="{{route('page.show', ['routeName' => 'howToOrder'])}}"><span>@langucw('how to order')</span></a>--}}
{{--                </li>--}}
{{--                <li><a class="sub-item-link"--}}
{{--                       href="{{route('page.show', ['routeName' => 'privacyPolicy'])}}"><span>@langucw('privacy policy')</span></a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}

{{--        <li><a class="menu-item-link" href="{{route('our_branches.show')}}"><span>@langucw('branches')</span></a></li>--}}

{{--        <li><a class="menu-item-link" href="#"><span>@langucw('language')</span></a>--}}
{{--            <ul class="sub-menu">--}}
{{--                <li><a class="sub-item-link" href="{{route('app.change_language',['lang'=>'ar'])}}"><span>@langucw('arabic')</span></a>--}}
{{--                </li>--}}
{{--                <li><a class="sub-item-link" href="{{route('app.change_language',['lang'=>'en'])}}"><span>@langucw('english')</span></a>--}}
{{--                </li>--}}

{{--            </ul>--}}
{{--        </li>--}}
    {{-- </ul>
</div> --}}
