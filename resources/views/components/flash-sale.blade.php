@php
    $discounts=\App\Services\DiscountService::getDiscount('section');
@endphp
@if($discounts)
<p>Flash Sale</p>
@endif

{{--@include('components.count-down',['end_time'=>$entity->EndDate])--}}
@foreach($discounts??[] as $discount)
    @foreach($discount['data'] as $id)
    @include('components.category',['id'=>$id,'EndDate'=>$discount['EndDate']])

@endforeach
@endforeach

