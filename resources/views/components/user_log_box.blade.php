<div class="row">
    <div class="-responsive">
        <table class=" table-bordered   hidden-xs " >
            <thead>
            <tr>
                <th class="chart-center">#</th>
                <th class="chart-center">{{trans('general.action')}}</th>
                <th class="chart-center">@langucw('source')</th>
                <th class="chart-center">@langucw('date')</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $user->userLogs->take(5)??[] as $index=>$item)
                <tr>
                    <td class="chart-center">{{$index}}</td>
                    <td class="chart-center">{{$item->data}}</td>
                    <td class="chart-center">{{$item->source}}</td>
                    <td class="chart-center">{{$item->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
