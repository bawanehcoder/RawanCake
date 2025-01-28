@extends('site.layout.master')
@section('title')
    @langucw('login')
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}">@langucw('home')</a></li>
    <li>@langucw('login')</li>
@endsection


@section('content')
    {{-- <br>
<br>
<br>

    <section>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        @include('components.login-buttons', [ 'guard' => 'web' ])
                        @if (Route::has('register'))
                            <button type="button" class="btn btn-primary" title="@langucw('register')" onclick="location.href='{{ route('register') }}';" >{{ __('register') }}</button>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<br>
<br>
<br>
<br> --}}

    <div class="col-12 py-5 px-5  login" style="background-color: #9E76B4;margin-bottom:-80px;">
        <div class="row mx-0">
            <div class="card px-0 col-md-6 m-auto">
                <div class="card-header text-center" style="border-bottom: 0;">
                    <h3>{{ __('login') }}</h3>
                </div>
                <div class="card-body  align-items-center m-auto">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="inputEmail">{{ __('Email Address') }}</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <div class="form-group mb-3">
                            <label for="inputPassword">{{ __('Password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-check-label"><input type="checkbox">{{__('Remember Me')}}</label>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                        <a href="{{ route('register') }}" class="btn btn-transparent-outlinet">{{__('register')}}</a>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>

                    @include('components.login-buttons', [ 'guard' => 'web' ])

                </div>
            </div>
        </div>
    </div>
    </section>
@endsection

{{-- @push('css')
    <style>
        .form-lovecake.full-form {
            display: block;
            width: 100%;
            text-align: left;
        }
        .form-lovecake {
            padding: 15px 15px;
            text-align: center;
            background: transparent;
            border: transparent;
            border-bottom: solid 1px black;
            color: white;
        }
        button, input {
            overflow: visible;
        }
    </style>
@endpush --}}
