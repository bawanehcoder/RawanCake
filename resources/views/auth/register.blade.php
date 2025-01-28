@extends('site.layout.master')
@section('title') @langucw('register') @endsection
@section('css') @endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">@langucw('home')</a></li>
    <li class="breadcrumb-item"><a href="{{route('login')}}">@langucw('login')</a></li>
    <li aria-current="page" class="breadcrumb-item active">@langucw('register')</li>
@endsection
@section('content')

    {{-- <div class="container text-center ">
        <div class="pad-top-150 row justify-content-center" style="padding-bottom: 200px;background-color: #fff;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4  text-center">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 ">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 ">{{ __('Phone number') }}</label>
                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                                           value="{{ old('phone') }}" required autocomplete="phone">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 ">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 ">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <select name="ZoneID" autocomplete="off" id="ZoneID" class="form-select">
                                        @foreach(\App\Models\Zones::all() ??[] as $zone)
                                            <option value="{{$zone->id}}">{{$zone->AddresAr}}   </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 ">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                    <select name="gender" autocomplete="off" id="gender" class="form-select">

                                        <option value="0">{{__('Male')}}   </option>
                                        <option value="1">{{__('Female')}}   </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="col-12 py-5 px-5  login" style="background-color: #9E76B4;margin-bottom:-80px;">
        <div class="row mx-0">
            <div class="card px-0 col-md-6 m-auto">
                <div class="card-header text-center" style="border-bottom: 0;">
                    <h3>{{ __('register') }}</h3>
                </div>
                <div class="card-body align-items-center mx-10">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4  ">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                   class="col-md-4 ">{{ __('Email Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email"
                                   class="col-md-4 ">{{ __('phone number') }}</label>
                            <div class="col-md-8">
                                <input id="phone" type="text"
                                       class="form-control @error('phone') is-invalid @enderror" name="phone"
                                       value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password"
                                   class="col-md-4 ">{{ __('Password') }}</label>
                            <div class="col-md-8">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3" style="display: none">
                            <label for="password"
                                   class="col-md-4 ">{{ __('branch') }}</label>
                            <div class="col-md-8">
                                <select name="ZoneID" autocomplete="off" id="ZoneID" class="form-select">
                                    @foreach(\App\Models\Zones::all() ??[] as $zone)
                                        <option value="{{$zone->id}}">{{$zone->AddresAr}}   </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password"
                                   class="col-md-4 ">{{ __('gender') }}</label>
                            <div class="col-md-8">
                                <select name="gender" autocomplete="off" id="gender" class="form-control">

                                    <option value="0">{{__('male')}}   </option>
                                    <option value="1">{{__('female')}}   </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
