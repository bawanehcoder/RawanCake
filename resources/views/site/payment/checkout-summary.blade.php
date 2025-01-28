<div class="checkout-box">

    <h4 class="mb-4">{{ __('total') }}</h4>

    <table class="">
        <thead>
        <tr>
            <th>{{ __('product') }}</th>
            <th>{{ __('total') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($carts??[] as $index=>$cart)
          <tr>
                     <td>
                         {{$cart->item->getTitle()}} ({{$cart->price}}) * {{$cart->quantity}}
                         @if($cart->optionDetil())
                             @foreach($cart->optionDetil()->get()??[] as $option)
                                 <br>
                                 {{$option->subOption->getTitle()}} ({{$option->AdditionalValue}})

                             @endforeach
                         @endif
                     </td>
              @php
                  $price=    $cart->price ;
              @endphp
                     <td>{{number_format((float)($price*$cart->quantity), 2, '.', '')}} {{$currency}}</td>
                 </tr>
          @php
               $subtotal+=($price*$cart->quantity);
               $discount+=\App\Services\DiscountService::getDiscountByItemFromCart($cart);

          @endphp
        @endforeach



        <tr>
            <td class="border-top" >@langucw('sub total')</td>
            <td class="border-top"><span
                    id="subtotal">{{number_format((float)$subtotal, 2, '.', '')}}</span> {{$currency}}</td>
        </tr>
        <tr>
            <td class="border-top">@langucw('shipping fee')</td>
            <td class="border-top">
                <span id="delivery_price">{{$delivery_price}}</span> {{$currency}}
            </td>
        </tr>
         <tr>
            <td class="border-top">{{trans('general.discounts')}}</td>
            <td class="border-top">
                <span id="discount">{{number_format((float)$discount, 2, '.', '')}}</span> {{$currency}}
            </td>
          </tr>
        <tr>
            <td class="border-top">@langucw('points')</td>
            <td class="border-top">
                <span id="points">{{number_format((float)$point_price, 2, '.', '')}}</span> {{$currency}}
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <th class="border-top">@langucw('grand total')</th>
            <th class="border-top">
                <span id="total">{{number_format((float)($subtotal-$discount+$delivery_price), 2, '.', '')}}</span> {{$currency}}
            </th>
        </tr>
        </tfoot>
    </table>

</div>
