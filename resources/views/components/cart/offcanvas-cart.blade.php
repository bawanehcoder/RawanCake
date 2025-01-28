@php
    $currency=app()->make(\App\Repositories\GenralSettingRepository::class)->getCurrency();
@endphp
<div id="cart_content">
    <div class="offcanvas-body" style="overflow: auto; max-height: 450px;">
        <ul class="offcanvas-cart-items">
            @php $subtotal=0; @endphp
            @foreach($carts??[] as $cart)
                @if($cart->item)
                    <li>
                        <!-- Mini Cart Item Start  -->
                        <div class="mini-cart-item">
                            <a onclick="deleteItem('{{route('cart.delete',$cart)}}')" class="mini-cart-item__remove"><i
                                    class="lastudioicon lastudioicon-e-remove red"></i></a>
                            <div class="mini-cart-item__thumbnail">
                                <a href="{{route('products.show',$cart->item)}}"><img width="60" height="88"
                                                                                      src="{{asset($cart->item->getFirstMediaUrl('products', 'small'))}}"
                                                                                      alt="Cart"></a>
                            </div>
                            @php
                                $price=  $cart->item->price() +  ($cart->optionDetil()?$cart->optionDetil()->sum('AdditionalValue'):0) ;
                                $subtotal+=($price*$cart->quantity);
                            @endphp
                            <div class="mini-cart-item__content">
                                <h6 class="mini-cart-item__title"><a
                                        href="{{route('products.show',$cart->item)}}">{{$cart->item->getTitle()}}</a>
                                </h6>
                                <span class="mini-cart-item__quantity">{{$cart->quantity}} × {{$price}}</span>
                            </div>
                        </div>
                        <!-- Mini Cart Item End  -->
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="offcanvas-footer d-flex flex-column gap-4">
        <!-- Mini Cart Total End  -->
        <div class="mini-cart-total">
            <strong class="label">@langucw('subtotal'):</strong>
            <strong class="value">{{$subtotal}} {{$currency}}</strong>
        </div>
        <!-- Mini Cart Total End  -->

        <!-- Mini Cart Button End  -->
        <div class="mini-cart-btn d-flex flex-column gap-2">
            <a class="d-block btn btn-secondary btn-hover-primary" href="{{route('cart.view_cart')}}">@langucw('view
                cart')</a>
            {{--        <a class="d-block btn btn-secondary btn-hover-primary" href="#">Checkout</a>--}}
        </div>
        <!-- Mini Cart Button End  -->

    </div>
</div>
