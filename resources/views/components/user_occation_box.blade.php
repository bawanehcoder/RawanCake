<div class="row">
    <div class="-responsive">
        <table class=" table-bordered   hidden-xs " style="background-color: white">
            <thead>
            <tr>
                <th style="width: 10%">#</th>
                <th style="width: 20%">@langucw('image')</th>
                <th style="width: 40%">{{trans('general.name')}}</th>
                <th>@langucw('date')</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $user->userOccasion??[] as $index=>$item)
                <tr>
                    <td>{{$index}}</td>
                    <td>
                        <img class="product-img " src="{{\App\Services\UserOccasionService::getImage($item)}}" alt="">
                    </td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
