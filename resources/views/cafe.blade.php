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
            <div class="col-lg-3 mb-3">
                <div class="side-bar p-3">
                    <h3>@langucw('category')</h3>

                    @php
                        $sub_categorys = \App\Models\Category::where('CatID', 6526)->get();
                    @endphp

                    @foreach ($sub_categorys as $category)
                    <label style="padding: 6px 26px;" data-aos="fade-right" class="category-items-checkbox">
                        <a class="sub-item-link " href="{{ route('cafe', $category->id) }}">
                            <span >{{ $category->getName() }}</span>
                        </a>
                        <input type="radio" class="filter-form sidebar-item-title"  @if( $sub && ( $sub->id == $category->id ) ) checked @endif name="categories" id="cat_01" />
                        <div class="checkmark"></div>
                    </label>
                @endforeach
                </div>
            </div>

            <div class=" col-lg-9 product">
                <div class="row mx-0">
                    <h1>
                        @if($sub)
                        {{ $sub->getName() }}
                        @else
                        @langucw('Rawan Cafe')
                        @endif

                    </h1>
                </div>

                <div class="d-flex flex-row  row mt-4">
                    @foreach ($products ?? [] as $product)
                        @php
                            $discount = app()->make(\App\Services\DiscountService::class)->getDiscountByItem($product);
                            $endDate = app()
                                ->make(\App\Services\DiscountService::class)
                                ->getDiscountEndDateByItem($product);
                        @endphp

                        @if ($product)
                            @php
                                $discount = app()
                                    ->make(\App\Services\DiscountService::class)
                                    ->getDiscountByItem($product);

                            @endphp

                            <div data-aos="fade-down" class="d-flex flex-column col-lg-4 mb-4">
                                <div class="card p-3" id="card">

                                    @if ($product->Special > 0)
                                        {{-- <div class="product-item__badge">{{ trans('general.discount') }} </div> --}}
                                        <div class="position-absolute Special-label">
                                            {{ __('Before 1 day') }}
                                        </div>
                                    @endif

                                    @if ($product->new)
                                        {{-- <div class="product-item__badge">{{ trans('general.discount') }} </div> --}}
                                        <div class="position-absolute Special-label">
                                            {{ __('New') }}
                                        </div>
                                    @endif

                                    @if ($discount > 0)
                                        {{-- <div class="product-item__badge">{{ trans('general.discount') }} </div> --}}
                                        <div class="position-absolute offer-label">
                                            {{ $discount }} %
                                        </div>
                                    @endif
                                    <a href="" class="d-flex align-items-center justify-content-between">

                                        <div class="d-none product-fun p-3">
                                            <div class="d-flex align-items-center justify-content-between gap-2">

                                            </div>
                                        </div>
                                        @auth
                                            @if ($product->isFavorite())
                                                <div class="position-absolute"
                                                    @if (auth()->user()) onclick="addToFavorite({{ $product->id }})" @endif>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        fill="#BE66E3" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                                    </svg>
                                                </div>
                                            @endif
                                        @endauth



                                        <img src="{{ asset($product->getFirstMediaUrl('products', 'medium')) }}"
                                            class="w-50 d-flex mx-auto" id="image_1" />
                                    </a>

                                    <div class="mt-3 d-flex align-items-center justify-content-between ">
                                        <a href="" class="d-flex align-items-center justify-content-between">
                                            <h3 class="m-0">
                                                <h3 class="mt-3">{{ $product->getTitle() }}</h3>
                                            </h3>
                                        </a>
                                        @php $offer=$product?->offerActive->last(); @endphp



                                        <div class="d-flex flex-column">
                                            <h3>{{ $product->price() }} JD</h3>
                                        </div>

                                    </div>
                                    <a href="#" class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex flex-row ">

                                        </div>
                                        @if ($offer)
                                            <h6 class="m-0"> {{ $product->price2() }}</h6>
                                        @endif

                                    </a>
                                </div>




                            </div>
                        @endif
                    @endforeach
                </div>


            </div>
        </div>
    </div>

    <div id="divLargerImage"></div>
    <div id="divOverlay"></div>

    <style>
        .position-absolute.Special-label {
            background: #9128bd;
            color: #fff;
            padding: 2px 13px;
        }

        div#card {}

        .product .card {
            border: 1px solid #ddd;
            /* min-height: 275px; */
        }

        .card .mt-3.d-flex.align-items-center.justify-content-between {
            padding: 15px;
        }

        .card a.d-flex.align-items-center.justify-content-between:nth-child(1) {
            min-height: 150px !important;
        }

        .card div a.d-flex.align-items-center.justify-content-between:nth-child(1) {
            min-height: 85px !important;
        }
        a.fixedshop.tow{
            display: none !important
        }
    </style>
@endsection

@push('scripts')
    <script></script>
@endpush
