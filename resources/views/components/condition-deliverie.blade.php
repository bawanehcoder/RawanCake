<div class="container items-custom">
@php
    $conditions=\App\Services\ConditionalDeliverieService::getConditionalDeliverie();
@endphp
@if($conditions)
    <h2>Delivery</h2>
@endif
@foreach($conditions??[] as $condition)
    @include('components.condition-items',['condition'=>$condition])
@endforeach

</div>