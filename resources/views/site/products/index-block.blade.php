<div class="d-flex flex-row  row mt-4">
    @foreach($products??[] as $product)
        @php
        $discount=app()->make(\App\Services\DiscountService::class)->getDiscountByItem($product);
        $endDate= app()->make(\App\Services\DiscountService::class)->getDiscountEndDateByItem($product);
        @endphp

        @include('components.product',[
            'discount'=>$discount,
            'endDate'=>$endDate,

                ])
    @endforeach
</div>
{{-- @include('components.page-show',['products'=>$products]) --}}
{{-- paginations --}}
{{--withQueryString()->--}}
{{-- <div att_last="{{$products->lastPage()}}" id="product_links">
    @if($products->lastPage() > 1)
        <div id="products" class="shop-bottombar">
            {{ $products->onEachSide(1)->links() }}
        </div>
    @endif
</div> --}}



{{-- <div class="d-flex flex-row justify-content-between row mt-4">
    
    <div class="d-flex flex-column col-lg-4 mb-4">
        <div class="card p-3" id="card">
            <div class="d-none product-fun  p-3">
                <div class="d-flex align-items-center justify-content-between gap-2">
                    <a href="JavaScript:void(0)" class="d-flex">
                        <img src="assets/images/ic_pro_fun_zoom.svg"
                            onclick="zoomImage('image_1');" />
                    </a>
                    <a href="#" class="d-flex">
                        <img src="assets/images/ic_pro_fun_fav.svg" />
                    </a>
                    <a href="JavaScript:void(0)"
                        onclick="addToCard({id: 1, name: 'Mini Cake', price: '10'})" class="d-flex">
                        <img src="assets/images/ic_pro_fun_card.svg" />
                    </a>
                    <a href="#" class="d-flex">
                        <img src="assets/images/ic_pro_fun_checkout.svg" />
                    </a>
                </div>
            </div>
            <img src="assets/images/product.png" class="w-50 d-flex mx-auto" id="image_1" />
        </div>
        <a href="#" class="d-flex flex-column">
            <h3 class="mt-3">Mini Cake</h3>
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-row">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                </div>
                <div class="d-flex">
                    <h3> JOD 1.00</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="d-flex flex-column col-lg-4 mb-4">
        <div class="card p-3" id="card">
            <div class="d-none product-fun  p-3">
                <div class="d-flex align-items-center justify-content-between gap-2">
                    <a href="JavaScript:void(0)" class="d-flex">
                        <img src="assets/images/ic_pro_fun_zoom.svg"
                            onclick="zoomImage('image_1');" />
                    </a>
                    <a href="#" class="d-flex">
                        <img src="assets/images/ic_pro_fun_fav.svg" />
                    </a>
                    <a href="JavaScript:void(0)"
                        onclick="addToCard({id: 1, name: 'Mini Cake', price: '10'})" class="d-flex">
                        <img src="assets/images/ic_pro_fun_card.svg" />
                    </a>
                    <a href="#" class="d-flex">
                        <img src="assets/images/ic_pro_fun_checkout.svg" />
                    </a>
                </div>
            </div>
            <img src="assets/images/product.png" class="w-50 d-flex mx-auto" id="image_1" />
        </div>
        <a href="#" class="d-flex flex-column">
            <h3 class="mt-3">Mini Cake</h3>
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-row">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                </div>
                <div class="d-flex">
                    <h3> JOD 1.00</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="d-flex flex-column col-lg-4 mb-4">
        <div class="card p-3" id="card">
            <div class="d-none product-fun  p-3">
                <div class="d-flex align-items-center justify-content-between gap-2">
                    <a href="JavaScript:void(0)" class="d-flex">
                        <img src="assets/images/ic_pro_fun_zoom.svg"
                            onclick="zoomImage('image_1');" />
                    </a>
                    <a href="#" class="d-flex">
                        <img src="assets/images/ic_pro_fun_fav.svg" />
                    </a>
                    <a href="JavaScript:void(0)"
                        onclick="addToCard({id: 1, name: 'Mini Cake', price: '10'})" class="d-flex">
                        <img src="assets/images/ic_pro_fun_card.svg" />
                    </a>
                    <a href="#" class="d-flex">
                        <img src="assets/images/ic_pro_fun_checkout.svg" />
                    </a>
                </div>
            </div>
            <img src="assets/images/product.png" class="w-50 d-flex mx-auto" id="image_1" />
        </div>
        <a href="#" class="d-flex flex-column">
            <h3 class="mt-3">Mini Cake</h3>
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-row">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                </div>
                <div class="d-flex">
                    <h3> JOD 1.00</h3>
                </div>
            </div>
        </a>
    </div>
</div> --}}
{{-- <div class="d-flex flex-row pagination">
    <a href="#" class="prev btn">Previews</a>
    <a href="#" class="no active btn">1</a>
    <a href="#" class="no btn">2</a>

    <a href="#" class="next btn">Next</a>

</div> --}}








