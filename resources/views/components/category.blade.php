@php
    if(isset($id) && $id>0){
        $entity=app()->make(\App\Repositories\MainCategoriesRepository::class)->findById($id);
    }
@endphp
@if($entity)

    <div class="swiper-slide">
        <!-- Product Item Strat -->
        <div class="product-item-style-01">
            <div class="product-item-style-01__image">
                <a href="{{route('products.index',[$entity->CatID,$entity->id])}}"><img width="270" height="270" class="d-none" src="{{$entity->getFirstMediaUrl('categories','small')??''}}" alt="Product"></a>
            </div>


            <div class="product-item-style-01__content-wrapper d-flex justify-content-between align-items-center">
                <div class="product-item-style-01__content">
                    <h5 class="product-item-style-01__title"><a href="{{route('products.index',[$entity->CatID,$entity->id])}}">{{$entity->getName()}}</a></h5>
                    @include('components.count-down',['end_time'=>$EndDate])
                </div>

            </div>
        </div>
        <!-- Product Item End -->
    </div>






@endif

