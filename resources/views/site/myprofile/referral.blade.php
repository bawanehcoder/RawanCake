<div class="tab-pane fade" id="referral">
    <div class="myaccount-content referral">
        <div class="-responsive">
            @include('components.referral-header')
            {{-- <div class="team-3-content">
                <div class="team-3-head">
                    <span class="team-3-name">{{getLogged()->usersIReferred()->count()}}  @langucw('referrals count')</span>
                    <span class="team-3-name">{{getLogged()->referralProfits()}}  @langucw('profits')</span>
                </div>
            </div> --}}
            <table class="">
                <thead>
                <tr>
                    <th>{{trans('general.id')}}</th>
                    <th>@langucw('user')</th>
                    <th>@langucw('date')</th>

                </tr>
                </thead>
                <tbody>

                @foreach(getLogged()->usersIReferred()->orderBy('id', 'desc')->get() as $referral)
                <tr>
                    <td>{{ $referral->id }}</td>
                    <td>{{ ($referral->registerer->name) }}</td>
                    <td>{{ $referral->created_at->format('Y-m-d') }}</td>

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
