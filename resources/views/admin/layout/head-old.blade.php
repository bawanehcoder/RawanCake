{{--<title>@yield('title')</title>--}}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
<link rel="icon" href="favicon.ico">
<title>{{trans('general.rwan_cacke')}}</title>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
{{--<!-- Ionicons -->--}}
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
      href="{{asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

<!-- Select2 -->
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
<link rel="stylesheet" href="{{asset('css/uppy.min.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery.steps.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">
<link rel="stylesheet" href="{{asset('css/quill.snow.css')}}">
<!-- Date Range Picker CSS -->
<link rel="stylesheet" href="{{asset('css/daterangepicker.css')}}">

<!-- Theme style -->
<link rel="stylesheet" href="{{asset('assets/plugins/adminlte.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
@if(\Config::get('app.locale') == 'ar')
    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
@endif
{{--<!-- Daterange picker -->--}}
{{--<link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">--}}
{{--<!-- summernote -->--}}
{{--<link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.min.css')}}">--}}
<!-- Simple bar CSS -->
{{--<link rel="stylesheet" href="{{asset('css/simplebar.css')}} ">--}}
<!-- Fonts CSS -->
{{--<link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">--}}
<!-- Icons CSS -->
{{--<link rel="stylesheet" href="{{asset('css/feather.css')}}">--}}
{{--<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">--}}
{{--<link rel="stylesheet" href="{{asset('css/select2.css')}}">--}}
{{--<link rel="stylesheet" href="{{asset('css/dropzone.css')}}">--}}
{{--<link rel="stylesheet" href="{{asset('css/uppy.min.css')}}">--}}
{{--<link rel="stylesheet" href="{{asset('css/jquery.steps.css')}}">--}}
{{--<link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">--}}
{{--<link rel="stylesheet" href="{{asset('css/quill.snow.css')}}">--}}
{{--<!-- Date Range Picker CSS -->--}}
{{--<link rel="stylesheet" href="{{asset('css/daterangepicker.css')}}">--}}
<!-- App CSS -->
{{--<link rel="stylesheet" href="{{asset('css/app-light.css')}}" id="lightTheme">--}}
{{--<link rel="stylesheet" href="{{asset('css/app-dark.css')}}" id="darkTheme" disabled>--}}
@include('flatpickr::components.style')
@include('flatpickr::components.script')
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" id="darkTheme" >--}}

<style>
    body {
        font-family: font, sans-serif, "Font Awesome 5 Free";
        overflow-x: hidden;
        color: #202020;
        background-color: #eff1f5
    }

    @font-face {
        font-family: font;
        src: url("{{asset('fonts/Cairo-Regular.ttf')}}");
        font-display: swap
    }

    html[dir=ltr] body {
        direction: ltr;
        text-align: left
    }

    html[dir=rtl] body {
        direction: rtl;
        text-align: right
    }

    {{--    .btn-site {--}}
{{--        color: #ffffff;--}}
{{--        background-color: #9F76B4;--}}
{{--        border-color: #9F76B4;--}}
{{--    }--}}

{{--    input.larger {--}}
{{--        width: 30px;--}}
{{--        height: 30px;--}}
{{--    }--}}
.lbl-parent {
        text-align: right;
    }

    .bg-success-subtle {
        background-color: #dffcf0 !important;
    }

    .bg-warning-subtle {
        background-color: #fff7d6 !important;
    }

    .flatpickr-container .form-control, .flatpickr-input {
        border: 1px solid #ced4da !important;
    }


    .product-img {
        margin: 0 auto;
        width: 100px;
        max-height: 100px;
    }
</style>


@yield('css')



