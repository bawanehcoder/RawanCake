<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                            <a href="/dashboard" class=" {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"><i
                                    data-feather="grid"></i><span>Dashboard</span></a>

                        </li>
                        <li class="submenu ">
                            <a class="{{ request()->routeIs('dashboard.main-categories.index') ||
                            request()->is('dashboard/main-categories/*') ||
                            request()->routeIs('dashboard.sub-categories.index') ||
                            request()->is('dashboard/sub-categories/*') ||
                            request()->routeIs('dashboard.product-report.index') ||
                            request()->is('dashboard/product-report/*') ||
                            request()->routeIs('dashboard.product-options.index') ||
                            request()->is('dashboard/product-options/*') ||
                            request()->is('dashboard/products-options/*') ||
                            request()->routeIs('dashboard.operator.index') ||
                            request()->is('dashboard/operator/*') ||
                            request()->routeIs('dashboard.product-sub-options.index') ||
                            request()->is('dashboard/product-sub-options/*') ||
                            request()->routeIs('dashboard.region.index') ||
                            request()->is('dashboard/region/*') ||
                            request()->routeIs('dashboard.products.index') ||
                            request()->is('dashboard/products/*')
                                ? 'subdrop active'
                                : '' }}"
                                href="javascript:void(0);"><i
                                    data-feather="smartphone"></i><span>{{ trans('general.products_categories') }}</span><span
                                    class="menu-arrow"></span></a>

                            <ul>
                                @if (Admin()->can('main categories view'))
                                    <li><a class="{{ request()->routeIs('dashboard.main-categories.index') || request()->is('dashboard/main-categories/*') ? 'active' : '' }}"
                                            href="{{ route('dashboard.main-categories.index') }}">{{ trans('general.categories') }}</a>
                                    </li>
                                @endif

                                @if (Admin()->can('sub categories view'))
                                    <li><a class="{{ request()->routeIs('dashboard.sub-categories.index') || request()->is('dashboard/sub-categories/*') ? 'active' : '' }}"
                                            href="{{ route('dashboard.sub-categories.index') }}">{{ trans('general.sub_categories') }}</a>
                                    </li>
                                @endif


                                {{-- @if (Admin()->can('operators view'))
                                    <li><a class="{{ request()->routeIs('dashboard.operator.index') || request()->is('dashboard/operator/*') ? 'active' : '' }}"
                                            href="{{ route('dashboard.operator.index') }}">{{ trans('general.operator') }}</a>
                                    </li>
                                @endif --}}

                                @if (Admin()->can('regions view'))
                                    <li><a class="{{ request()->routeIs('dashboard.region.index') || request()->is('dashboard/region/*') ? 'active' : '' }}"
                                            href="{{ route('dashboard.region.index') }}">{{ trans('general.region') }}</a>
                                    </li>
                                @endif

                                @if (Admin()->can('products view'))
                                    <li><a class="{{ request()->routeIs('dashboard.products.index') || request()->is('dashboard/products/*') ? 'active' : '' }}"
                                            href="{{ route('dashboard.products.index') }}">{{ trans('general.products') }}</a>
                                    </li>
                                @endif

                                <li class="submenu submenu-two">
                                    @if (Admin()->can('option products view'))
                                        <a class="{{ request()->routeIs('dashboard.product-options.index') ||
                                        request()->is('dashboard/product-options/*') ||
                                        request()->routeIs('dashboard.product-sub-options.index') ||
                                        request()->is('dashboard/product-sub-options/*')
                                            ? 'active subdrop'
                                            : '' }}"
                                            href="javascript:void(0);">@langucw('product options')<span
                                                class="menu-arrow inside-submenu"></span></a>
                                        <ul>
                                            @if (Admin()->can('option products view'))
                                                <li><a class="{{ request()->routeIs('dashboard.product-options.index') || request()->is('dashboard/product-options/*') ? 'active' : '' }}"
                                                        href="{{ route('dashboard.product-options.index') }}">{{ trans('general.basic_options') }}</a>
                                                </li>
                                            @endif

                                            @if (Admin()->can('option products view'))
                                                <li><a class="{{ request()->routeIs('dashboard.product-sub-options.index') || request()->is('dashboard/product-sub-options/*') ? 'active' : '' }}"
                                                        href="{{ route('dashboard.product-sub-options.index') }}">{{ trans('general.sub_options') }}</a>
                                                </li>
                                            @endif

                                        </ul>
                                    @endif
                                </li>

                                @if (Admin()->can('products report view'))
                                    <li><a class="{{ request()->routeIs('dashboard.product-report.index') || request()->is('dashboard/product-report/*') ? 'active' : '' }}"
                                            href="{{ route('dashboard.product-report.index') }}">@langucw('products report')</a>
                                    </li>
                                @endif

                            </ul>
                        </li>



                        <li class="submenu ">
                            <a class="{{ request()->routeIs('dashboard.orders.index') ||
                            request()->routeIs('dashboard.sales-report.index') ||
                            request()->is('dashboard/orders/*')
                                ? 'subdrop active'
                                : '' }}"
                                href="javascript:void(0);"><i
                                    data-feather="smartphone"></i><span>{{ trans('general.requests') }}</span><span
                                    class="menu-arrow"></span></a>

                            <ul>

                                @if (Admin()->can('orders view'))
                                    <li>
                                        <a class="{{ (request()->routeIs('dashboard.orders.index') && request()->query('action') == 'NewOrder') || request()->is('dashboard/orders/show/*') || request()->is('dashboard/orders/edit/*') ? 'active' : '' }}"
                                            href="{{ route('dashboard.orders.index', ['action' => 'NewOrder']) }}">{{ trans('general.requests_new') }}</a>
                                    </li>

                                    <li>
                                        <a class="{{ (request()->routeIs('dashboard.orders.index') && request()->query('action') == 'AcceptedOrder') || request()->is('dashboard/orders/show/*') || request()->is('dashboard/orders/edit/*') ? 'active' : '' }}"
                                            href="{{ route('dashboard.orders.index', ['action' => 'AcceptedOrder']) }}">{{ trans('general.requests_accepted') }}</a>
                                    </li>

                                    <li>
                                        <a class="{{ (request()->routeIs('dashboard.orders.index') && request()->query('action') == 'RejectedOrder') || request()->is('dashboard/orders/show/*') || request()->is('dashboard/orders/edit/*') ? 'active' : '' }}"
                                            href="{{ route('dashboard.orders.index', ['action' => 'RejectedOrder']) }}">{{ trans('general.requests_rejected') }}</a>
                                    </li>
                                @endif

                                @if (Admin()->can('sales report view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.sales-report.index') ? 'active' : '' }}"
                                            href="{{ route('dashboard.sales-report.index') }}">{{ trans('general.sales_report') }}</a>
                                    </li>
                                @endif




                            </ul>
                        </li>


                        <li class="submenu ">
                            <a class="{{ request()->routeIs('dashboard.offers.index') ||
                            request()->is('dashboard/offers/*') ||
                            request()->is('dashboard/discounts/*') ||
                            request()->routeIs('dashboard.coupons.index') ||
                            request()->is('dashboard/coupons/*') ||
                            request()->routeIs('dashboard.discounts.index') ||
                            request()->routeIs('dashboard.coupons.index')
                                ? 'subdrop active'
                                : '' }}"
                                href="javascript:void(0);"><i
                                    data-feather="smartphone"></i><span>{{ trans('general.offers_and_discounts') }}</span><span
                                    class="menu-arrow"></span></a>

                            <ul>

                                @if (Admin()->can('offers view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.offers.index') || request()->is('dashboard/offers/*') ? 'active' : '' }}"
                                            href="{{ route('dashboard.offers.index') }}">{{ trans('general.offers') }}</a>
                                    </li>
                                @endif

                                @if (Admin()->can('discount view'))
                                    <li>
                                        <a class="{{ (request()->routeIs('dashboard.discounts.index') || request()->is('dashboard/discounts/*')) && request()->query('type') == 'section' ? 'active' : '' }}"
                                            href="{{ route('dashboard.discounts.index', ['type' => 'section']) }}">{{ trans('general.discount_on_a_section') }}</a>
                                    </li>
                                @endif

                                @if (Admin()->can('discount view'))
                                    <li>
                                        <a class="{{ (request()->routeIs('dashboard.discounts.index') || request()->is('dashboard/discounts/*')) && request()->query('type') == 'item' ? 'active' : '' }}"
                                            href="{{ route('dashboard.discounts.index', ['type' => 'item']) }}">{{ trans('general.discount_on_a_product') }}</a>
                                    </li>
                                @endif

                                @if (Admin()->can('discount view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.coupons.index') || request()->is('dashboard/coupons/*') ? 'active' : '' }} "
                                            href="{{ route('dashboard.coupons.index') }}">{{ trans('general.discount_coupon') }}</a>
                                    </li>
                                @endif

                            </ul>
                        </li>

                        @if (Admin()->can('users view'))
                            <li
                                class="{{ request()->routeIs('dashboard.users.index') || request()->is('dashboard/users/*') ? 'subdrop active' : '' }}">
                                <a class="" href="{{ route('dashboard.users.index') }}">
                                    <i data-feather="smartphone"></i>
                                    <span>{{ __('Customers')}}</span>
                                </a>
                            </li>
                        @endif

                        @if (Admin()->can('pages view'))
                            <li
                                class="{{ request()->routeIs('dashboard.pages.index') || request()->is('dashboard/pages/*') ? 'subdrop active' : '' }}">
                                <a class="" href="{{ route('dashboard.pages.index') }}">
                                    <i data-feather="smartphone"></i>
                                    <span>@langucw('pages')</span>
                                </a>
                            </li>
                        @endif


                        <li class="submenu ">
                            <a class="{{ request()->routeIs('dashboard.generalInfo.edit') || request()->routeIs('dashboard.branches.index')
                                ? 'subdrop active'
                                : '' }}"
                                href="javascript:void(0);"><i
                                    data-feather="smartphone"></i><span>@langucw('informations')</span><span
                                    class="menu-arrow"></span></a>

                            <ul>

                                @if (Admin()->can('general information view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.generalInfo.edit') ? 'active' : '' }}  "
                                            href="{{ route('dashboard.generalInfo.edit') }}">@langucw('general information')</a>
                                    </li>
                                @endif

                                @if (Admin()->can('branches view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.branches.index') ? 'active' : '' }}  "
                                            href="{{ route('dashboard.branches.index') }}">@langucw('branches')</a>
                                    </li>
                                @endif



                            </ul>
                        </li>


                        <li class="submenu ">
                            <a class="{{ request()->routeIs('dashboard.conditional-deliveries.index') ||
                            request()->routeIs('dashboard.generalSetting.edit') ||
                            request()->routeIs('dashboard.point-settings.index') ||
                            request()->routeIs('dashboard.application-gifts.index') ||
                            request()->routeIs('dashboard.occasions.index') ||
                            request()->routeIs('dashboard.categories_occasions.index') ||
                            request()->routeIs('dashboard.zones.index')
                                ? 'subdrop active'
                                : '' }}"
                                href="javascript:void(0);"><i
                                    data-feather="smartphone"></i><span>@langucw('settings')</span><span
                                    class="menu-arrow"></span></a>

                            <ul>

                                @if (Admin()->can('delivery locations view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.zones.index') ? 'active' : '' }}"
                                            href="{{ route('dashboard.zones.index') }}">@langucw('delivery locations')</a>
                                    </li>
                                @endif

                                @if (Admin()->can('conditional delivery view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.conditional-deliveries.index') ? 'active' : '' }}"
                                            href="{{ route('dashboard.conditional-deliveries.index') }}">@langucw('conditional delivery')</a>
                                    </li>
                                @endif


                                @if (Admin()->can('conditional delivery view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.generalSetting.edit') ? 'active' : '' }}"
                                            href="{{ route('dashboard.generalSetting.edit') }}">@langucw('general Settings')</a>
                                    </li>
                                @endif

                                @if (Admin()->can('point settings view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.point-settings.index') ? 'active' : '' }}"
                                            href="{{ route('dashboard.point-settings.index') }}">@langucw('point Settings')</a>
                                    </li>
                                @endif


                                @if (Admin()->can('application gifts view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.application-gifts.index') ? 'active' : '' }}"
                                            href="{{ route('dashboard.application-gifts.index') }}">@langucw('application gifts')</a>
                                    </li>
                                @endif

                                @if (Admin()->can('occasions view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.occasions.index') ? 'active' : '' }}"
                                            href="{{ route('dashboard.occasions.index') }}">@langucw('application gifts')</a>
                                    </li>
                                @endif

                                @if (Admin()->can('categories occasions view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.categories_occasions.index') ? 'active' : '' }}"
                                            href="{{ route('dashboard.categories_occasions.index') }}">@langucw('categories occasions')</a>
                                    </li>
                                @endif

                            </ul>
                        </li>


                        <li class="submenu ">
                            <a class="{{ request()->routeIs('dashboard.contacts.index') ||
                            request()->routeIs('dashboard.sliders.index') ||
                            request()->routeIs('dashboard.banner.index') ||
                            request()->routeIs('dashboard.user-admin.index') ||
                            request()->routeIs('dashboard.support-ticket.index') ||
                            request()->routeIs('dashboard.newsletters.index')
                                ? 'subdrop active'
                                : '' }}"
                                href="javascript:void(0);"><i data-feather="smartphone"></i><span>
                                    @langucw('the site')</span><span class="menu-arrow"></span></a>

                            <ul>

                                @if (Admin()->can('messages view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.contacts.index') ? 'active' : '' }}"
                                            href="{{ route('dashboard.contacts.index') }}">@langucw('messages')</a>
                                    </li>
                                @endif

                                @if (Admin()->can('slider view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.sliders.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.sliders.index') }}">@langucw('slider')</a>
                                    </li>
                                @endif

                                @if (Admin()->can('subscription mailing list view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.newsletters.index') ? 'active' : '' }} "
                                    href="{{ route('dashboard.newsletters.index') }}">@langucw('subscription mailing list')</a>
                                    </li>
                                @endif

                                @if (Admin()->can('subscription mailing list view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.banner.index') ? 'active' : '' }} "
                                    href="{{ route('dashboard.banner.index') }}">@langucw('banner')</a>
                                    </li>
                                @endif

                                @if (Admin()->can('subscription mailing list view'))
                                    <li>
                                        <a class="{{ request()->routeIs('dashboard.user-admin.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.user-admin.index') }}">@langucw('admins')</a>
                                    </li>
                                @endif

                            </ul>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
