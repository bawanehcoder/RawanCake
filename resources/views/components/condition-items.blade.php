@if($condition)
<div class="condition-item">
    <h3>{{$condition['title_'.strtolower(getLang())] }}</h3>
    <label>{{$condition->Delivery}}</label>
    <div class="zonez">
    @if(count($condition->zone_ids)==0)
        <label>All</label>
    @else
        @foreach(app()->make(\App\Repositories\ZoneRepository::class)->zoneIds($condition->zone_ids)  as $zone)
            <label>{{$zone->getTitle()}} <small>{{$condition->purchase_value}}</small></label>

        @endforeach
    @endif
</div>

    @if(count($condition->items)==0)
        <label>All</label>
    @else
    <div class="row">
        @foreach(app()->make(\App\Repositories\ItemRepository::class)->itemsIds($condition->items)  as $item)
        <div class="product-list-item col-md-4">
<div class="product-list-item__thumbnail">
<a href="{{ config('app.url') }}/products/show/6"><img class="" src="{{ config('app.url') }}/storage/media/products/d3ab9949d7c1de0ac51f71b5f9975581/c/uf6Vat90hLtHRHYWF39FQrUVUkaSjWR6-medium.jpg" width="270" height="270" alt="Product"></a>
<ul class="product-list-item__meta meta-middle">
<li class="product-list-item__meta-action"><a class="labtn-icon-quickview" onclick="if (!window.__cfRLUnblockHandlers) return false; quickview(6)" data-bs-tooltip="tooltip" data-bs-placement="top" title="" data-bs-original-title="عرض سريع" aria-label="عرض سريع"></a></li>
</ul>
</div>
<div class="product-list-item__info">
<h4 class="product-list-item__title"><a href="{{ config('app.url') }}/products/show/6">مفن كراميل</a>
</h4>
<span class="product-list-item__price">د.ا 1.30</span>
<div class="product-list-item__rating">
<div class="product-list-item__star-rating" style="width: 0%;"></div>
</div>
<p>كيك المفن المخبوز مُزين بالكريمة ومحشو بالكراميل....</p>
</div>
</div>
        @endforeach
</div>
    @endif
    <div class="mu-c">
        @include('components.count-down',['end_time'=>$condition->end_time])
    </div>
</div>
@endif



