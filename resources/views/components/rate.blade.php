
@if(!getLogged()->hasRated($product))
    <input type="hidden" id="rate" value="">
    <ul class="star">
        @for($j =1; $j <= 5; $j++)
            <li  class="review-rating-bg" style="width: {{10*$j}}%" onclick="AddToRate('{{$product->id}}','{{$j}}')"></li>
        @endfor
        @else

            @php $sum = $product->getAvarg() @endphp
            @for($i = 1; $i <= $sum; $i++)
                <li  class="fas fa-star yellowstar" onclick="AddToRate('{{$product->id}}','{{$i}}')">&nbsp;</li>
            @endfor
            @for($j = $sum + 1; $j <= 5; $j++)
                <li  class="fas fa-star " onclick="AddToRate('{{$product->id}}','{{$i}}')">&nbsp;</li>
            @endfor
    </ul>

@endif
{{$product->getRateCount()}} Customer Review
