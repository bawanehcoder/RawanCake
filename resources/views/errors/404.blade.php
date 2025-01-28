@extends('site.layout.master')
@section('title') @langucw('') @endsection
@section('css') @endsection
@section('breadcrumb')
    <li><a href="{{route('home')}}">@langucw('home')</a></li>
    <li>@langucw('page not found')</li>
@endsection
@section('content')
    <!-- Error Section Start -->
    <div class="error" data-bg-image="{{asset('site/bakerfresh/assets/images/404-bg.jpg')}}">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="error-image">
                        <img src="{{asset('site/bakerfresh/assets/images/404.png')}}" alt="404-image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="error-content">
                        <h1 class="error-content__title">@langucw('page not found') !!</h1>
                        <p class="error-content__text">@langucw('the page you are looking for might have been removed had its name changed or is temporarily unavailable').</p>
                        <a href="{{route('home')}}" class="btn btn-secondary btn-hover-primary" type="submit">@langucw('go to home')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Error Section End -->
@endsection
@section('scripts') @endsection


