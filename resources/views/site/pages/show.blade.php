@extends('site.layout.master', ['show_slider' => false, 'title' => $page->title])
@section('title', __($page->title))
@section('css') @endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}">@langucw('home')</a></li>
    <li> {{ __($page->title) }} </li>
@endsection
@section('content')
    @php
        $s = App\Models\Slide::first();
    @endphp
    <div class=" home-header parallax tow" id="home-header"
        style="background-image: url('{{ asset($s->getFirstMediaUrl('slider', 'full')) }}');    max-height: 159px;top: 0;z-index: 111;background-blend-mode: overlay;background-color: #312637;">
        <div class="header-container">

            <div >
                <div class="row d-flex justify-content-between align-items-end mx-0 ">
                    <div class="col-12">
                        <h1 class="text-center" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                            {{ __($page->title) }} </h1>
                        <h2 class="text-center w-50 m-auto" data-aos="fade-left" data-aos-offset="300"
                            data-aos-easing="ease-in-sine">
                            <a href="{{ route('home') }}">@langucw('home')</a>/
                            {{ __($page->title) }} 
                        </h2>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-padding-03 contact-section2 contact-section2_bg">
        <div class="container custom-container">
            <div class="has-padding page-content">{!! $page->getTranslation('content', app()->getLocale()) !!}</div>
        </div>
    </div>
@endsection
@section('scripts') @endsection
