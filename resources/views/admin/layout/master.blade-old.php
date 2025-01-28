<!DOCTYPE html>
<html lang="{{ getLang() == 'En' ? 'en' : 'ar' }}" dir="{{ getLang() == 'En' ? 'ltr' : 'rtl' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.layout.head')
</head>
<body class="hold-transition sidebar-mini @if(\Config::get('app.locale') == 'ar') rtl @endif  ">
{{--form used by js to delete resource on backend--}}

<div class="wrapper">
    
    @include('admin.layout.main-headerbar')
    @include('admin.layout.main-sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5> @yield('title')</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
    @include('admin.layout.footer')
</div>

@include('admin.layout.footer-scripts')
</body>
</html>
