<div class="row">
    <div class="-responsive">
        <table class=" table-bordered table-hover hidden-xs " style="background-color: white">
            <thead>
            <tr>
                <th class="chart-center">#</th>
                <th class="chart-center">@langucw('amount')</th>
                <th class="chart-center">@langucw('balance')</th>
                <th class="chart-center">@langucw('details')</th>
                <th class="chart-center">@langucw('date')</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $user->points??[] as $index=>$item)
                <tr>
                    <td class="chart-center">{{$index}}</td>
                    <td class="chart-center">{{$item->amount}}</td>
                    <td class="chart-center">{{$item->balance}}</td>
                    <td class="chart-center">{{$item->details}}</td>
                    <td class="chart-center">{{$item->created_at->format('Y-m-d')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


