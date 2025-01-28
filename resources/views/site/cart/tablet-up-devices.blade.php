<div class="card">
    @if(count($carts)>0)
        <table id="table" class="desktop-t">
            <thead>
            <tr class="no-bor-top">
                <th scope="col">@langucw('image')</th>
                <th scope="col">@langucw('product')</th>
                <th scope="col">@langucw('price')</th>
                <th scope="col">@langucw('quantity')</th>
                <th scope="col">@langucw('total')</th>
                <th scope="col">@langucw('Note')</th>
                <th scope="col">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($carts??[] as $index=>$cart)
                @if($cart->item)
                    <tr>
                       
                        <td>
                            <div class=""><img
                                        alt="Cake-one" class="full-image"
                                        src="{{asset($cart->item->getFirstMediaUrl('products', 'small'))}}"></div>
                        </td>
                        <td>
                            <h3>{{$cart->item->getTitle()}}
                                @if($cart->optionDetil())
                                    @foreach($cart->optionDetil()->get()??[] as $option)
                                        <br>
                                        <span>{{$option->subOption->getTitle()}} ({{$option->AdditionalValue}})</span>
                                    @endforeach
                                @endif
                            </h3>
                        </td>
                        @php
                            $price=    $cart->price ;

                        @endphp
                        <td>
                            <h3><div class="price-product price-{{$cart->id}}">{{$price}}</div></h3>
                        </td>
                        <td style="    text-align: -webkit-center;">
                            @include('components.btn-number',['id'=>$cart->id,'quantity'=>$cart->quantity])
                        </td>
                        <td>
                            <span
                                class="total total_{{$cart->id}}">{{ ($price*$cart->quantity)}}</span> {{$genralSetting->getCurrency()}}
                        </td>
                        <td>

                        {{ $cart->Note }}
                        </td>
                        <td>
                            <span style="cursor:pointer" onclick="deleteItem('{{route('cart.delete',$cart)}}')">
                                <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" style="
    fill: #F44336;
"><path d="M432 80h-82.38l-34-56.75C306.1 8.827 291.4 0 274.6 0H173.4C156.6 0 141 8.827 132.4 23.25L98.38 80H16C7.125 80 0 87.13 0 96v16C0 120.9 7.125 128 16 128H32v320c0 35.35 28.65 64 64 64h256c35.35 0 64-28.65 64-64V128h16C440.9 128 448 120.9 448 112V96C448 87.13 440.9 80 432 80zM171.9 50.88C172.9 49.13 174.9 48 177 48h94c2.125 0 4.125 1.125 5.125 2.875L293.6 80H154.4L171.9 50.88zM352 464H96c-8.837 0-16-7.163-16-16V128h288v320C368 456.8 360.8 464 352 464zM224 416c8.844 0 16-7.156 16-16V192c0-8.844-7.156-16-16-16S208 183.2 208 192v208C208 408.8 215.2 416 224 416zM144 416C152.8 416 160 408.8 160 400V192c0-8.844-7.156-16-16-16S128 183.2 128 192v208C128 408.8 135.2 416 144 416zM304 416c8.844 0 16-7.156 16-16V192c0-8.844-7.156-16-16-16S288 183.2 288 192v208C288 408.8 295.2 416 304 416z"></path></svg>
                            </span>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endif
</div>

