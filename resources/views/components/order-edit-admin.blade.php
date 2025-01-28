<div class="card-body">
    {{--order-edit-admin--}}
<table class=" table table-bordered mb-0 " style="background-color: white">
    <thead>
    <tr>
        <th class="chart-center">@langucw('no')</th>
        <th class="chart-center">@langucw('product')</th>
        <th class="chart-center">@langucw('image')</th>

        <th class="chart-center" style="width: 150px">@langucw('quantity')</th>
        <th class="chart-center">@langucw('price')</th>
        <th class="chart-center">@langucw('total')</th>
        <th class="chart-center">@langucw('notes')</th>
        <th class="chart-center">@langucw('special image')</th>
        <th class="chart-center">{{trans('general.action')}}</th>
    </tr>
    </thead>
    <tbody>
    @php $subtotal=0;$discount=0; @endphp
    @foreach($entity->order_details??[] as $index=>$item)
        {{--                        --}}
        <div id="form_{{$item->id}}"     method="POST">
            @csrf
            {{--                        <input type="hidden" name="quantity" id="quantity_{{$item->id}}" value="{{$item->Quantity}}">--}}
            <tr>
                <td class="chart-center">{{$index}}</td>
                <td class="chart-center" id="{{$item->item->id}}">{{$item->item->getTitle()}}
                    ({{$item->item->Price()}})

                    @if($item->optionDetil())
                        @foreach($item->optionDetil()->get()??[] as $option)
                            <br>
                            {{$option->subOption->getTitle()}} ({{$option->AdditionalValue}})
                @endforeach
                @endif
                <td class="chart-center"><a target="_blank"
                                            href="{{route('products.show',$item->item)}}"><img
                            alt="Cake-one" class="img-100px img-thumbnail"
                            src="{{asset($item->item->getFirstMediaUrl('products', 'small'))}}"></a>
                </td>

                <td class="chart-center "><input type="number"  att="{{$item->id}}"
                                                 id="input_number-{{$item->id}}"
                                                 class="form-control input_number" autocomplete="off" name="quantity"
                                                 value="{{$item->Quantity}}" min="1" max="1000"></td>
                @php
                    $subtotal+=$item->Price*$item->Quantity;
                    $discountItem=\App\Services\DiscountService::getDiscountByItemFromCart($item);

                    $discount+=$discountItem;

                @endphp
                <td class="chart-center price-{{$item->id}} discount-item" discount="{{$discountItem/$item->Quantity}}"
                    quantity="{{$item->Quantity}}"
                    price="{{$item->Price}}">{{number_format((float)($item->Price), 2, '.', '')}} {{$currency}}</td>


                <td class="chart-center "><span
                        class="total total_{{$item->id}}">{{number_format((float)($item->Price*$item->Quantity), 2, '.', '')}}</span> {{$currency}}
                </td>

                <td class="chart-center">{{$item->Note}} </td>
                <td>
                    @if($item->getFirstMediaUrl('images','large'))
                        <a target="_blank"
                           href="{{asset($item->getFirstMediaUrl('images','large'))??''}}?v={{now()}}"><img
                                class="thumbnail"
                                src="{{asset($item->getFirstMediaUrl('images','small'))??''}}?v={{now()}}"></a></td>
                @endif
                <td class="chart-center">
                    <button
                        onclick="updateItemInOrder({{$item->id}},'{{route('dashboard.orders.update-item',[$entity,$item])}}')"
                        class="btn btn-pink-cake mar-right-10">{{trans('general.update')}}
                    </button>
                    <button
                        onclick="deleteItemInOrder('{{route('dashboard.orders.delete-item',[$entity,$item])}}')"
                        class="btn btn-pink-cake mar-right-10">@langucw('delete')
                    </button>

                </td>
            </tr>
        </div>
    @endforeach
    <tr>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center">@langucw('subtotal')</td>
        <td style="border: none;" class="chart-center "><span
                id="subtotal">{{number_format((float)$subtotal, 2, '.', '')}}</span> {{$currency}}</td>
    </tr>
    <tr>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center">@langucw('delivery fee')</td>
        <td style="border: none;" class="chart-center "><span att="{{$entity->ZonePrice}}"
                                                              id="ZonePrice">{{number_format((float)$entity->ZonePrice, 2, '.', '')}}</span> {{$currency}}
        </td>
    </tr>
    <tr>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center">{{trans('general.discount')}}</td>
        <td style="border: none;" class="chart-center "><span
                id="Discount">{{number_format((float)$discount, 2, '.', '')}}</span> {{$currency}}</td>
    </tr>
    <tr>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center"></td>
        <td style="border: none;" class="chart-center">@langucw('total amount')</td>
        <td style="border: none;" class="chart-center ">
            <span
                id="Total">{{number_format((float)$entity->Total+$entity->AddValue+$entity->ZonePrice-$discount, 2, '.', '')}}</span>
            {{$currency}}</td>
    </tr>

    </tbody>
</table>

@include('components.script-input_number')


</div>