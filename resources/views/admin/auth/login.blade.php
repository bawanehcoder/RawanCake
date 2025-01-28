<!DOCTYPE html>
<html lang="{{ \Config::get('app.locale') == 'en' ? 'en' : 'ar' }}" dir="{{ \Config::get('app.locale') == 'en' ? 'ltr' : 'rtl' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.layout.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">





    <section class=" text-center text-lg-start" >
        @include('components.messagesAndErrors')

        <div class=" card table-list-card mb-3">
            <div class="row g-0 d-flex align-items-center">

                <div class="col-lg-4 d-none d-lg-flex">
                    <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes"
                         class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
                </div>
                <div class="col-lg-8">
                    <div class=" card-body table-list-card-body py-5 px-md-5">

                        <div class="dropdown lang-drop p-4">
                            <button class="lang-icon" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                    <span>
                        <i class="fas fa-globe"></i>
                        <span>@langucw('language')</span>
                    </span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('app.change_language', ['lang' => 'ar']) }}">
                                    <img src="/modules/base/img/static/sa.webp" alt="" class="flag">
                                    عربي
                                </a>
                                <a class="dropdown-item" href="{{ route('app.change_language', ['lang' => 'en']) }}">
                                    <img src="/modules/base/img/static/uk.webp" alt="" class="flag">
                                    English
                                </a>
                            </div>
                        </div>

                        <div class="px-5 ms-xl-4">
                            <i class="fas  fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                            <span class="h1 fw-bold mb-0">@langucw('rwan cacke')</span>
                        </div>

                        <form method="POST" action="{{ route('dashboard.login') }}" >
                            @csrf
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">@langucw('log in')</h3>

                            <div class="form-outline mb-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label class="form-label" for="form2Example18">@langucw('email address')</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">@langucw('password') </label>

                            </div>

                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit">@langucw('login')</button>
                            </div>

                            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="{{route('dashboard.password.request')}}">
                                    @langucw('forgot password?')</a></p>


                        </form>

                    </div>
                </div>
            </div>
        </div>





        <footer  >
            All rights reserved © {{ config('app.name') }} {{ now()->format('Y') }}
        </footer>
        @include('admin.layout.footer-scripts')

    </section>

</div>



</body>
</html>
