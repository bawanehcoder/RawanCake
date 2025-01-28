<!DOCTYPE html>
<html lang="en">
@include('admin.layout.head')


<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">


        @include('admin.layout.main-headerbar')
        @include('admin.layout.main-sidebar')


        <div class="page-wrapper">
            <div class="content">
                @yield('content')
            </div>

        </div>

    </div>


    @include('admin.layout.footer-scripts')

</body>

</html>
