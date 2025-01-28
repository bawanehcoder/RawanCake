@extends('site.layout.master')
@section('title') @langucw('') @endsection
@section('css') @endsection
@section('breadcrumb')
@endsection
@section('content')

    <div class="col-12 py-5  login" style="background-color: #9E76B4;margin-bottom:-80px;">
        <div class="row mx-0">
            <div class="card px-0 col-6 m-auto">
                <div class="card-header text-center" style="border-bottom: 0;">
                    <h3>{{ __('Reset Password') }}</h3>
                </div>

                <div class="card-body col-8 align-items-center m-auto">
                    <form method="POST" action="{{ route('password.email') }}">
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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
