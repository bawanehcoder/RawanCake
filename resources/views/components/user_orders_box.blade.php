<div class="row">
    <div class="-responsive">
        <table class=" table-bordered table-hover hidden-xs " style="background-color: white">
            <thead>
            <tr>
                <th class="chart-center">#</th>
                <th class="chart-center">{{trans('general.name')}}</th>
                <th class="chart-center">@langucw('total')</th>
                <th class="chart-center">@langucw('delivery time')</th>
                <th class="chart-center">@langucw('status')</th>
                <th class="chart-center">@langucw('payment method')</th>
                <th class="chart-center">@langucw('show')</th>
            </tr>
            </thead>
            <tbody>
            @if($user)
                @foreach($user->order??[] as $index=>$item)
                    <tr>
                        <td class="chart-center">{{$index}}</td>
                        <td class="chart-center">{{$item->Name}}</td>
                        <td class="chart-center">{{$item->Total}}</td>
                        <td class="chart-center">{{$item->DeliveryTime}} {{getDayNames($item->DeliveryTime)}}</td>
                        <td class="chart-center">{{$item->status}}</td>
                        <td class="chart-center">{{$item->PaymentMethod}}</td>
                        <td class="chart-center"><a href="{{route('dashboard.orders.show',$item)}}">@langucw('show')</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>


