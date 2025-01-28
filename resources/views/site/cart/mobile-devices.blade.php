<div class="cart-products-mobile d-md-none">
    @if (count($carts) > 0)
        @foreach ($carts ?? [] as $index => $cart)
            @if ($cart->item)
                <div class="cart-product-mobile">
                    <div class="cart-product-mobile-thumb">
                        <a href="{{ route('products.show', $cart->item) }}" class="cart-product-mobile-image"><img
                                src="{{ asset($cart->item->getFirstMediaUrl('products', 'small')) }}"
                                alt="Croissant Italy Cake" width="90" height="103">
                            @if ($cart->getFirstMediaUrl('images', 'large'))
                                <a class="img-product" target="_blank"
                                    href="{{ asset($cart->getFirstMediaUrl('images', 'large')) ?? '' }}?v={{ now() }}"><img
                                        width="90px" height="103px" class="full-image"
                                        src="{{ asset($cart->getFirstMediaUrl('images', 'small')) ?? '' }}?v={{ now() }}"></a>
                            @endif
                        </a>
                        <button onclick="deleteItem('{{ route('cart.delete', $cart) }}')"
                            class="cart-product-mobile-remove"><i class="lastudioicon lastudioicon-e-remove"></i>
                        </button>
                    </div>
                    <div class="cart-product-mobile-content">
                        <h5 class="cart-product-mobile-title"><a
                                href="{{ route('products.show', $cart->item) }}">{{ $cart->item->getTitle() }}
                                @if ($cart->optionDetil())
                                    @foreach ($cart->optionDetil()->get() ?? [] as $option)
                                        <br>
                                        <span>{{ $option->subOption->getTitle() }}
                                            ({{ $option->AdditionalValue }})</span>
                                    @endforeach
                                @endif

                            </a></h5>
                        <span class="cart-product-mobile-quantity">{{ $cart->quantity }} x
                            ({{ $cart->item->price() }})</span>
                        @php
                            $price =  $cart->price;

                        @endphp
                        <span class="cart-product-mobile-total "><b>@langucw('total'):</b> <span
                                class="total total_{{ $cart->id }}">{{ $price * $cart->quantity }}</span></span>
                        <!-- Quantity Start -->
                        @include('components.btn-number', [
                            'id' => $cart->id,
                            'quantity' => $cart->quantity,
                        ])
                        <!-- Quantity End -->


                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
