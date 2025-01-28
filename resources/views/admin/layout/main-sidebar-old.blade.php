<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('general.rwan_cacke') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column  " data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link  {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('dashboard.main-categories.index') ||
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
                        ? 'menu-open   '
                        : '' }}">
                    <a href="/dashboard"
                        class="nav-link
                                {{ request()->routeIs('dashboard.main-categories.index') ||
                                request()->is('dashboard/main-categories/*') ||
                                request()->routeIs('dashboard.sub-categories.index') ||
                                request()->is('dashboard/sub-categories/*') ||
                                request()->is('dashboard/products-options/*') ||
                                request()->routeIs('dashboard.operator.index') ||
                                request()->is('dashboard/operator/*') ||
                                request()->routeIs('dashboard.product-report.index') ||
                                request()->is('dashboard/product-report/*') ||
                                request()->routeIs('dashboard.product-options.index') ||
                                request()->is('dashboard/product-options/*') ||
                                request()->routeIs('dashboard.product-sub-options.index') ||
                                request()->is('dashboard/product-sub-options/*') ||
                                request()->routeIs('dashboard.region.index') ||
                                request()->is('dashboard/region/*') ||
                                request()->routeIs('dashboard.products.index') ||
                                request()->is('dashboard/products/*')
                                    ? ' active '
                                    : '' }}">
                        <i class="nav-icon fas fas fa-cubes"></i>
                        <p>
                            {{ trans('general.products_categories') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Admin()->can('main categories view'))
                            <li class="nav-item">
                                <a class="nav-link   {{ request()->routeIs('dashboard.main-categories.index') || request()->is('dashboard/main-categories/*') ? 'active' : '' }}"
                                    href="{{ route('dashboard.main-categories.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.categories') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (Admin()->can('sub categories view'))
                            <li class="nav-item">
                                <a class="nav-link  {{ request()->routeIs('dashboard.sub-categories.index') || request()->is('dashboard/sub-categories/*') ? 'active' : '' }}"
                                    href="{{ route('dashboard.sub-categories.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.sub_categories') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (Admin()->can('operators view'))
                            <li class="nav-item"><a
                                    class="nav-link {{ request()->routeIs('dashboard.operator.index') || request()->is('dashboard/operator/*') ? 'active' : '' }}"
                                    href="{{ route('dashboard.operator.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.operator') }}</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('regions view'))
                            <li class="nav-item">
                                <a class="nav-link  {{ request()->routeIs('dashboard.region.index') || request()->is('dashboard/region/*') ? 'active' : '' }}"
                                    href="{{ route('dashboard.region.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.region') }}</p>
                                </a>
                            </li>
                        @endif
                        @if (Admin()->can('option products view'))
                            <li class="nav-item">
                                <a class="nav-link  {{ request()->routeIs('dashboard.products.index') || request()->is('dashboard/products/*') || request()->is('dashboard/products-options/*') ? 'active' : '' }}"
                                    href="{{ route('dashboard.products.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.products') }}</p>
                                </a>
                            </li>
                        @endif

                        <li
                            class="nav-item{{ request()->routeIs('dashboard.product-options.index') ||
                            request()->is('dashboard/product-options/*') ||
                            request()->routeIs('dashboard.product-sub-options.index') ||
                            request()->is('dashboard/product-sub-options/*')
                                ? 'menu-open'
                                : '' }}">
                            @if (Admin()->can('option products view'))
                                <a href="#" class="nav-link             ">
                                    <i class="nav-icon fas fas fa-cubes"></i>
                                    <p>
                                        @langucw('product options')
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (Admin()->can('option products view'))
                                        <li class="nav-item">
                                            <a class="nav-link  {{ request()->routeIs('dashboard.product-options.index') || request()->is('dashboard/product-options/*') ? 'active' : '' }}"
                                                href="{{ route('dashboard.product-options.index') }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ trans('general.basic_options') }}</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Admin()->can('option products view'))
                                        <li class="nav-item">
                                            <a class="nav-link  {{ request()->routeIs('dashboard.product-sub-options.index') || request()->is('dashboard/product-sub-options/*') ? 'active' : '' }}"
                                                href="{{ route('dashboard.product-sub-options.index') }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ trans('general.sub_options') }}</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </li>
                        @if (Admin()->can('products report view'))
                            <li class="nav-item">
                                <a class="nav-link  {{ request()->routeIs('dashboard.product-report.index') || request()->is('dashboard/product-report/*') ? 'active' : '' }}"
                                    href="{{ route('dashboard.product-report.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('products report')</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li
                    class="nav-item  {{ request()->routeIs('dashboard.orders.index') || request()->routeIs('dashboard.sales-report.index') || request()->is('dashboard/orders/*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link
                    {{ request()->routeIs('dashboard.orders.index') || request()->routeIs('dashboard.sales-report.index') || request()->is('dashboard/orders/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fas fa-cubes"></i>
                        <p>
                            {{ trans('general.requests') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Admin()->can('orders view'))
                            <li class="nav-item">
                                <a class="nav-link  {{ (request()->routeIs('dashboard.orders.index') && request()->query('action') == 'NewOrder') || request()->is('dashboard/orders/show/*') || request()->is('dashboard/orders/edit/*') ? 'active' : '' }}"
                                    href="{{ route('dashboard.orders.index', ['action' => 'NewOrder']) }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.requests_new') }}</p>
                                </a>
                            </li>

                            <li class="nav-item"><a
                                    class="nav-link  {{ request()->routeIs('dashboard.orders.index') && request()->query('action') == 'AcceptedOrder' ? 'active' : '' }}"
                                    href="{{ route('dashboard.orders.index', ['action' => 'AcceptedOrder']) }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.requests_accepted') }}</p>
                                </a></li>

                            <li class="nav-item"><a
                                    class="nav-link  {{ request()->routeIs('dashboard.orders.index') && request()->query('action') == 'RejectedOrder' ? 'active' : '' }}"
                                    href="{{ route('dashboard.orders.index', ['action' => 'RejectedOrder']) }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.requests_rejected') }}</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('sales report view'))
                            <li class="nav-item">
                                <a class="nav-link  {{ request()->routeIs('dashboard.sales-report.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.sales-report.index') }}"> <i
                                        class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.sales_report') }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>

                </li>
                <!-- hon -->

                <li
                    class="nav-item
                {{ request()->routeIs('dashboard.offers.index') ||
                request()->is('dashboard/offers/*') ||
                request()->is('dashboard/discounts/*') ||
                request()->routeIs('dashboard.coupons.index') ||
                request()->is('dashboard/coupons/*') ||
                request()->routeIs('dashboard.discounts.index') ||
                request()->routeIs('dashboard.coupons.index')
                    ? 'menu-open'
                    : '' }}">
                    <a href="#"
                        class="nav-link
                    {{ request()->routeIs('dashboard.offers.index') || request()->is('dashboard/discounts/*') || request()->routeIs('dashboard.coupons.index') || request()->is('dashboard/coupons/*') || request()->is('dashboard/offers/*') || request()->routeIs('dashboard.discounts.index') || request()->routeIs('dashboard.coupons.index') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-gift"></i>
                        <p>
                            {{ trans('general.offers_and_discounts') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Admin()->can('offers view'))
                            <li class="nav-item"><a
                                    class="nav-link {{ request()->routeIs('dashboard.offers.index') || request()->is('dashboard/offers/*') ? 'active' : '' }}"
                                    href="{{ route('dashboard.offers.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.offers') }}</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('discount view'))
                            <li class="nav-item"><a
                                    class="nav-link  {{ (request()->routeIs('dashboard.discounts.index') || request()->is('dashboard/discounts/*')) && request()->query('type') == 'section' ? 'active' : '' }}"
                                    href="{{ route('dashboard.discounts.index', ['type' => 'section']) }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.discount_on_a_section') }}</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('discount view'))
                            <li class="nav-item"><a
                                    class="nav-link {{ (request()->routeIs('dashboard.discounts.index') || request()->is('dashboard/discounts/*')) && request()->query('type') == 'item' ? 'active' : '' }}"
                                    href="{{ route('dashboard.discounts.index', ['type' => 'item']) }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.discount_on_a_product') }}</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('discount view'))
                            <li class="nav-item"><a
                                    class="nav-link  {{ request()->routeIs('dashboard.coupons.index') || request()->is('dashboard/coupons/*') ? 'active' : '' }} "
                                    href="{{ route('dashboard.coupons.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ trans('general.discount_coupon') }}</p>
                                </a></li>
                        @endif
                    </ul>
                </li>
                @if (Admin()->can('users view'))
                    <li class="nav-item ">
                        <a href="{{ route('dashboard.users.index') }}"
                            class=" nav-link {{ request()->routeIs('dashboard.users.index') || request()->is('dashboard/users/*') ? 'active' : '' }} ">
                            <i class="nav-icon fas fas fa-users"></i>
                            <p>{{ trans('general.users') }}</p>
                        </a>
                    </li>
                @endif
                @if (Admin()->can('pages view'))
                    <li class="nav-item "><a href="{{ route('dashboard.pages.index') }}"
                            class=" nav-link {{ request()->routeIs('dashboard.pages.index') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-th"></i>
                            <p>@langucw('pages')</p>
                        </a>
                    </li>
                @endif

                <li
                    class="nav-item   {{ request()->routeIs('dashboard.generalInfo.edit') || request()->routeIs('dashboard.branches.index') ? 'menu-open' : '' }} ">
                    <a href="#"
                        class="nav-link  {{ request()->routeIs('dashboard.generalInfo.edit') || request()->routeIs('dashboard.branches.index') ? 'active' : '' }} ">
                        <i class="nav-icon fa fa-info-circle"></i>
                        <p>
                            @langucw('informations')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Admin()->can('general information view'))
                            <li class="nav-item"><a
                                    class="nav-link  {{ request()->routeIs('dashboard.generalInfo.edit') ? 'active' : '' }}  "
                                    href="{{ route('dashboard.generalInfo.edit') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('general information')</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('branches view'))
                            <li class="nav-item"><a
                                    class="nav-link  {{ request()->routeIs('dashboard.branches.index') ? 'active' : '' }}  "
                                    href="{{ route('dashboard.branches.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('branches')</p>
                                </a></li>
                        @endif
                    </ul>
                </li>

                <li
                    class="nav-item   {{ request()->routeIs('dashboard.conditional-deliveries.index') ||
                    request()->routeIs('dashboard.generalSetting.edit') ||
                    request()->routeIs('dashboard.point-settings.index') ||
                    request()->routeIs('dashboard.application-gifts.index') ||
                    request()->routeIs('dashboard.occasions.index') ||
                    request()->routeIs('dashboard.categories_occasions.index') ||
                    request()->routeIs('dashboard.zones.index')
                        ? 'menu-open'
                        : '' }}  ">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('dashboard.conditional-deliveries.index') ||
                        request()->routeIs('dashboard.generalSetting.edit') ||
                        request()->routeIs('dashboard.point-settings.index') ||
                        request()->routeIs('dashboard.application-gifts.index') ||
                        request()->routeIs('dashboard.occasions.index') ||
                        request()->routeIs('dashboard.categories_occasions.index') ||
                        request()->routeIs('dashboard.zones.index')
                            ? 'active'
                            : '' }}  ">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            @langucw('settings')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Admin()->can('delivery locations view'))
                            <li class="nav-item"><a
                                    class="nav-link  {{ request()->routeIs('dashboard.zones.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.zones.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('delivery locations')</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('conditional delivery view'))
                            <li class="nav-item"><a
                                    class="nav-link   {{ request()->routeIs('dashboard.conditional-deliveries.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.conditional-deliveries.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('conditional delivery')</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('general settings view'))
                            <li class="nav-item"><a
                                    class="nav-link  {{ request()->routeIs('dashboard.generalSetting.edit') ? 'active' : '' }}"
                                    href="{{ route('dashboard.generalSetting.edit') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('general Settings')</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('point settings view'))
                            <li class="nav-item"><a
                                    class="nav-link  {{ request()->routeIs('dashboard.point-settings.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.point-settings.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('point settings')</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('application gifts view'))
                            <li class="nav-item"><a
                                    class="nav-link  {{ request()->routeIs('dashboard.application-gifts.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.application-gifts.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('application gifts')</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('occasions view'))
                            <li class="nav-item"><a
                                    class="nav-link  {{ request()->routeIs('dashboard.occasions.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.occasions.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('occasions')</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('categories occasions view'))
                            <li class="nav-item"><a
                                    class="nav-link  {{ request()->routeIs('dashboard.categories_occasions.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.categories_occasions.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('categories occasions')</p>
                                </a></li>
                        @endif
                    </ul>
                </li>
                <li
                    class="nav-item   {{ request()->routeIs('dashboard.contacts.index') ||
                    request()->routeIs('dashboard.sliders.index') ||
                    request()->routeIs('dashboard.banner.index') ||
                    request()->routeIs('dashboard.user-admin.index') ||
                    request()->routeIs('dashboard.support-ticket.index') ||
                    request()->routeIs('dashboard.newsletters.index')
                        ? 'menu-open'
                        : '' }}">
                    <a href="#"
                        class="nav-link  {{ request()->routeIs('dashboard.contacts.index') ||
                        request()->routeIs('dashboard.sliders.index') ||
                        request()->routeIs('dashboard.support-ticket.index') ||
                        request()->routeIs('dashboard.banner.index') ||
                        request()->routeIs('dashboard.user-admin.index') ||
                        request()->routeIs('dashboard.newsletters.index')
                            ? 'active'
                            : '' }}">
                        <i class="nav-icon fa fa-sitemap"></i>
                        <p>
                            @langucw('the site')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Admin()->can('messages view'))
                            <li class="nav-item"><a
                                    class="nav-link {{ request()->routeIs('dashboard.contacts.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.contacts.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('messages')</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('slider view'))
                            <li class="nav-item"><a
                                    class="nav-link {{ request()->routeIs('dashboard.sliders.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.sliders.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('slider')</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('subscription mailing list view'))
                            <li class="nav-item"><a
                                    class="nav-link {{ request()->routeIs('dashboard.newsletters.index') ? 'active' : '' }} "
                                    href="{{ route('dashboard.newsletters.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('subscription mailing list')</p>
                                </a>
                            </li>
                        @endif
                        @if (Admin()->can('customer data view'))
                            <li class="nav-item"><a class="nav-link " href="./page-404.html">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('customer data')</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('slider view'))
                            <li class="nav-item"><a
                                    class="nav-link {{ request()->routeIs('dashboard.banner.index') }} "
                                    href="{{ route('dashboard.banner.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('banner')</p>
                                </a></li>
                        @endif


                        @if (Admin()->can('users admin view'))
                            <li class="nav-item"><a
                                    class="nav-link {{ request()->routeIs('dashboard.user-admin.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.user-admin.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('admins')</p>
                                </a></li>
                        @endif
                        @if (Admin()->can('technical support view'))
                            <li class="nav-item"><a
                                    class="nav-link {{ request()->routeIs('dashboard.support-ticket.index') ? 'active' : '' }}"
                                    href="{{ route('dashboard.support-ticket.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@langucw('technical support')</p>
                                </a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item  d-none">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-sitemap"></i>
                        <p>
                            @langucw('the list')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Admin()->can('menu sliders report view'))
                            <a class="nav-link " href="{{ route('dashboard.menu-sliders.index') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@langucw('slider')</p>
                            </a>
                        @endif
                        <a class="nav-link " href="./auth-login-half.html">
                            <i class="far fa-circle nav-icon"></i>
                            <p>@langucw('sections')</p>
                        </a>
                        <a class="nav-link " href="./auth-register.html">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ trans('general.products') }}</p>
                        </a>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('dashboard.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-fw fa-sign-out-alt"></i>
                        <p>@langucw('log out')</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
