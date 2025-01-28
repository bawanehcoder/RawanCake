@if(isset($favorites) && count($favorites))
    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 row-cols-1 mb-n50">
        @foreach($favorites??[] as $favorite)
            @php
                $discount=app()->make(\App\Services\DiscountService::class)->getDiscountByItem($favorite->product);
                $endDate= app()->make(\App\Services\DiscountService::class)->getDiscountEndDateByItem($favorite->product);
                $offer=$favorite->product?->offerActive->last() ;
            @endphp
            @include('components.product',[
            'product'=>$favorite->product,
            'discount'=>$discount,
            'endDate'=>$endDate
            ])
        @endforeach
    </div>
    @include('components.page-show',['products'=>$favorites])

    {{-- paginations --}}
    <div>
        @if($favorites->lastPage() > 1)
            <div att_last="{{$favorites->lastPage()}}" id="favorite" class="shop-bottombar paginations ">
                {{ $favorites->links() }}
            </div>
        @endif
    </div>

@endif




