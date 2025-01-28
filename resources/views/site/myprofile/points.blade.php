<div class="tab-pane fade" id="points">
    <div class="myaccount-content points">
        <div class="-responsive">

            {{-- <div class="team-3-content">
                <div class="team-3-head">
                    <span class="team-3-name">{{getLogged()->totalPoints()}}  @langucw('your avaiable points')</span>
                    <span class="team-3-name">{{getLogged()->convertPointstoMoney(getLogged()->totalPoints())}}  @langucw('profits')</span>
                </div>
            </div> --}}
            <div class="d-flex flex-row justify-content-between profile gap-2">
                <div class="d-flex flex-row w-50 align-items-center p-5  card-counter">
                    <div class="counter">{{ getLogged()->totalPoints() }}</div>
                    <h3 class="mx-4">@langucw('your avaiable points')</h3>
                </div>
                <div class="d-flex flex-row  w-50 align-items-center p-5  card-counter">
                    <div class="counter">{{getLogged()->convertPointstoMoney(getLogged()->totalPoints())}}</div>
                    <h3 class="mx-4">@langucw('profits')</h3>
                </div>
            </div>
            <br>
            <table class="">
                <thead>
                <tr>
{{--                    <th>{{trans('general.id')}}</th>--}}
                    <th>@langucw('amount')</th>
                    <th>@langucw('balance')</th>
                    <th>@langucw('details')</th>
                    <th>@langucw('date')</th>


                </tr>
                </thead>
                <tbody>

                @foreach(getLogged()->points()->get() as $index=>$point)
                <tr>
                    <td>{{ ($point->amount) }}</td>
                    <td>{{ ($point->balance) }}</td>
                    <td>{{$point->details}}</td>
                    <td>{{ $point->created_at->format('Y-m-d') }}</td>

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
