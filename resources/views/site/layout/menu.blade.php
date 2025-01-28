<div class="offcanvas offcanvas-end offcanvas-menu bg-secondary" id="offcanvasMenu">
    <div class="offcanvas-header justify-content-end">
        <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas"><i
                class="lastudioicon-e-remove"></i></button>
    </div>
    <div class="offcanvas-body">
        <ul class="mobile-primary-menu">
            <li>
                <a href="{{route('home')}}" class="menu-item-link active"><span>@langucw('home')</span></a>

            </li>
            <li class="position-static">
                <a class="menu-item-link" href="#"><span>@langucw('shop')</span></a>
                <ul class="sub-menu sub-menu-mega">
                    <li class="mega-menu-item">
                        <ul>
                            @foreach(app()->make(\App\Repositories\MainCategoriesRepository::class)->get() as $cat)
                                <li><a class="sub-item-link"
                                       href="{{route('products.index',[$cat->id])}}"><span>{{$cat->getName()}}</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                </ul>
            </li>
            <li><a class="menu-item-link" href="#"><span>@langucw('pages')</span></a>
                <ul class="sub-menu">
                    <li><a class="sub-item-link"
                           href="{{route('favorites.index')}}"><span>@langucw('wishlist')</span></a>
                    </li>
                    <li><a class="sub-item-link"
                           href="{{route('contact_us.show')}}"><span>@langucw('contact')</span></a>
                    </li>
                    <li><a class="sub-item-link"
                           href="{{route('page.show', ['routeName' => 'about'])}}"><span>@langucw('about')</span></a>
                    </li>
                    <li><a class="sub-item-link"
                           href="{{route('contact_us.show')}}"><span>@langucw('contact')</span></a>
                    </li>
                    <li><a class="sub-item-link"
                           href="{{route('page.show', ['routeName' => 'termsAndConditions'])}}"><span>@langucw('terms and conditions')</span></a>
                    </li>
                    <li><a class="sub-item-link" href="{{route('page.show', ['routeName' => 'ourStory'])}}"><span>@langucw('our story')</span></a>
                    </li>
                    <li><a class="sub-item-link"
                           href="{{route('page.show', ['routeName' => 'howToOrder'])}}"><span>@langucw('how to order')</span></a>
                    </li>
                    <li><a class="sub-item-link"
                           href="{{route('page.show', ['routeName' => 'privacyPolicy'])}}"><span>@langucw('privacy policy')</span></a>
                    </li>
                </ul>
            </li>

            <li><a class="menu-item-link"
                   href="{{route('our_branches.show')}}"><span>@langucw('branches')</span></a></li>

            <li><a class="menu-item-link" href="#"><span>@langucw('language')</span></a>
                <ul class="sub-menu">
                    <li><a class="sub-item-link" href="{{route('app.change_language',['lang'=>'ar'])}}"><span>@langucw('arabic')</span></a>
                    </li>
                    <li><a class="sub-item-link" href="{{route('app.change_language',['lang'=>'en'])}}"><span>@langucw('english')</span></a>
                    </li>

                </ul>
            </li>

        </ul>

    </div>
</div>
