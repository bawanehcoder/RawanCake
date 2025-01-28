{{--<nav class="topnav navbar navbar-light">--}}
{{--    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">--}}
{{--        <i class="fe fe-menu navbar-toggler-icon"></i>--}}
{{--    </button>--}}
{{--    <form class="form-inline mr-auto searchform text-muted">--}}
{{--        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search"--}}
{{--               placeholder="Type something..." aria-label="Search">--}}
{{--    </form>--}}
{{--    <ul class="nav">--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">--}}
{{--                <i class="fe fe-sun fe-16"></i>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        <li class="nav-item nav-notif">--}}
{{--            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">--}}
{{--                <span class="fe fe-bell fe-16"></span>--}}
{{--                <span class="dot dot-md bg-success"></span>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        <li class="nav-item nav-notif">--}}
{{--            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">--}}
{{--                <span class="fe fe-mail fe-16"></span>--}}
{{--                <span class="dot dot-md bg-success">{{$messageCount??0}}</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item nav-notif">--}}
{{--            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">--}}
{{--                <span class="fe fe-user fe-16"></span>--}}
{{--                <span class="dot dot-md bg-success">{{$countOfOnlineUsers??0}}</span>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        <li class="nav-item nav-notif">--}}
{{--            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">--}}
{{--                <span class="fe fe-users fe-16"></span>--}}
{{--                <span class="dot dot-md bg-success">{{$countOfUsers??0}}</span>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        @if( strtolower(getLang()) =='en')--}}
{{--            <li class="nav-item nav-notif">--}}
{{--                <a class="nav-link text-muted my-2" href="{{route('app.change_language',['lang'=>'ar'])}}">--}}
{{--                    <span>Arabic</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        @endif--}}
{{--        @if( strtolower(getLang()) =='ar')--}}
{{--            <li class="nav-item nav-notif">--}}
{{--                <a class="nav-link text-muted my-2" href="{{route('app.change_language',['lang'=>'en'])}}">--}}
{{--                    <span>English</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        @endif--}}
{{--    </ul>--}}
{{--</nav>--}}

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class=" {{\Config::get('app.locale') == 'ar'?'navbar-nav mr-auto-navbav':'navbar-nav ml-auto'}}">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>

        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
        </li>

        @if( strtolower(getLang()) =='en')
            <li class="nav-item ">
                <a class="nav-link  " href="{{route('app.change_language',['lang'=>'ar'])}}">
                    <span>Arabic</span>
                </a>
            </li>
        @endif
        @if( strtolower(getLang()) =='ar')
            <li class="nav-item ">
                <a class="nav-link text-muted my-2" href="{{route('app.change_language',['lang'=>'en'])}}">
                    <span>English</span>
                </a>
            </li>
        @endif
    </ul>
</nav>
<!-- /.navbar -->
