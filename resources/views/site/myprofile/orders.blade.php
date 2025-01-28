<div class="tab-pane fade" id="orders">
    <div class="myaccount-content order">
        <div class="-responsive">
            <table class="">
                <thead>
                <tr>
{{--                    <th class="chart-center">#</th>--}}
                    <th class="chart-center">{{trans('general.name')}}</th>
                    <th class="chart-center">@langucw('total')</th>
                    <th class="chart-center">@langucw('delivery time')</th>
                    <th class="chart-center">@langucw('status')</th>
                    <th class="chart-center">@langucw('payment method')</th>
                    <th>{{trans('general.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @if(isLogged())
                    @foreach(getLogged()->order??[] as $index=>$item)
                        <tr>
{{--                            <td class="chart-center">{{$index}}</td>--}}
                            <td class="chart-center">{{$item->Name}}</td>
                            <td class="chart-center">{{$item->Total}}</td>
                            <td class="chart-center">{{$item->DeliveryTime}} {{getDayNames($item->DeliveryTime)}}</td>
                            <td class="chart-center">{{$item->status}}</td>
                            <td class="chart-center">{{$item->PaymentMethod}}</td>
                            <td class="chart-center"><a href="{{route('order.show',$item)}}"><b>@langucw('show')</b></a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
