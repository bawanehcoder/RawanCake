@extends('site.layout.master',['show_slider'=>false,'title'=>@langucw('our branches'),'color'=>'blue'])
@section('title')
    @langucw('our branches')
@endsection
@section('css')



@endsection
@section('breadcrumb')
@endsection
@section('content')

    <!--  Section Start -->
    <div class="shop-product-section blog-sidebar blog-sidebar-right">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12 section-padding-04">
                    <div class="blog-sidebar_ml">
                        @foreach($branches??[] as $index=>$branche)
                            <div class="blog-post">

                                <div class="blog-post__content">
                                    {{-- <h3 class="blog-post__title">{{$branche->Phone}}</h3> --}}
                                    <h4 class="blog-post__text">{{$branche->getTitle()}}</h4>

                                    <iframe class="map-responsive embed-responsive-item" width="100%" height="450px"
                                            style="border:6px solid white;"
                                            loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"
                                            src="{{$branche->Map}}"></iframe>


                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Section End -->

@endsection
@section('scripts')



@endsection
