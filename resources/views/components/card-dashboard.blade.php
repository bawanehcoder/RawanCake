@php
    $subtotal=0;
    $carts=\App\Models\Cart::where('user_id', $user->id)->get();;
@endphp
@if(count($carts)>0)
    <div class="row">
        <div class="-responsive">
            <table id="table" class=" table-bordered table-hover hidden-xs">
                <thead>
                <tr>
                    <th class="chart-center">@langucw('no')</th>
                    <th class="chart-center">@langucw('product')</th>
                    <th class="chart-center">@langucw('image')</th>
                    <th class="chart-center">@langucw('description')</th>
                    <th class="chart-center" style="width: 150px">@langucw('quantity')</th>
                    <th class="chart-center">@langucw('price')</th>
                    <th class="chart-center">@langucw('total')</th>

                </tr>
                </thead>
                <tbody>


                @foreach($carts??[] as $index=>$cart)
                    <tr>
                        <td class="chart-center">{{$index+1}}</td>
                        <td class="chart-center">{{$cart->item->getTitle()}} ({{$cart->item->price()}})

                            @if($cart->optionDetil())
                                @foreach($cart->optionDetil()->get()??[] as $option)
                                    <br>
                                    {{$option->subOption->getTitle()}} ({{$option->AdditionalValue}})

                                @endforeach
                            @endif
                        </td>
                        <td class="chart-center"><a href="{{route('products.show',$cart->item)}}"><img alt="Cake-one"
                                                                                                       class="img-100px img-thumbnail"
                                                                                                       src="{{asset($cart->item->getFirstMediaUrl('products', 'small'))}}"></a>
                        </td>
                        <td class="chart-description">
                            {{$cart->item->getDescription()}}
                        </td>
                        <td class="chart-center ">{{$cart->quantity}}</td>
                        @php
                            $price=  $cart->item->price() +  ($cart->optionDetil()?$cart->optionDetil()->sum('AdditionalValue'):0) ;
                            $subtotal+=(   $price   *$cart->quantity);
                        @endphp
                        <td class="chart-center price-{{$cart->id}}">{{$price}} </td>

                        <td class="chart-center"><span
                                class="total total_{{$cart->id}}">{{ ($price*$cart->quantity)}}</span></td>

                    </tr>

                @endforeach
                <tr>
                    <td style="border: none;" class="chart-center"></td>
                    <td style="border: none;" class="chart-center"></td>
                    <td style="border: none;" class="chart-center"></td>
                    <td style="border: none;" class="chart-description"></td>
                    <td style="border: none;" class="chart-center"></td>

                    <td style="border: none;" class="chart-center">@langucw('subtotal')</td>
                    <td style="border: none;" class="chart-center subtotal">{{(float)$subtotal}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif


