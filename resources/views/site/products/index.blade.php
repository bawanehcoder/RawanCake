@extends('site.layout.master')
@section('title')
    {{ trans('general.products') }}
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}">@langucw('home')</a></li>
    <li>@langucw('Product') </li>
@endsection
@section('content')
    <div class="container mt-10">
        <div class="row mx-0">
            @if ($search == '')
                <div class="col-lg-3">
                    <div class="side-bar p-3">
                        <h3>@langucw('category')</h3>



                        @include('site.products.sidebars-widget-category')



                    </div>
                </div>
            @endif
            <div class="@if ($search == '') col-lg-9 @else col-lg-12 @endif product">
                <div class="row mx-0">
                    <h1>
                        @if ($search == '')
                            @if($sub_category)
                            {{ $sub_category->getName() }}
                            @elseif ($main_category)
                                {{ $main_category->getName() }}
                            @else
                                @langucw('Product')
                            @endif
                        @else
                            {{-- @include('components.page-show', ['show' => true]) --}}
                        @endif
                    </h1>
                </div>

                @include('site.products.index-block')


            </div>
        </div>
    </div>

    <div id="divLargerImage"></div>
    <div id="divOverlay"></div>
@endsection

@push('scripts')
    <script></script>
@endpush
