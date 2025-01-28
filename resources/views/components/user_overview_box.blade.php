<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" style="    max-height: 120px;" src="{{ $user->avatar }}"
                 alt="User profile picture">
        </div>
        <h3 class="profile-username text-center">{{ $user->name }}</h3>
        <p class="text-muted text-center">{{ $user->email }}</p>
        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Total points</b> <a class="float-right">{{$user->convertPointstoMoney($user->totalPoints())  }}</a>
            </li>
            <li class="list-group-item">
                <b>@langucw('points money')</b> <a
                    class="float-right">{{$user->convertPointstoMoney($user->totalPoints())  }}</a>
            </li>
            <li class="list-group-item">
                <b>@langucw('order count')</b> <a class="float-right">{{$user->orderCount()}}</a>
            </li>
            <li class="list-group-item">
                <b>@langucw('registered since')</b> <a class="float-right">{{$user->created_at->diffForHumans()}}</a>
            </li>
            <li class="list-group-item">
                <b>@langucw('last seen')</b> <a class="float-right">
                    @if($user->isOnline())
                        <i class='fas fa-plug' style='color:green;'></i> @langucw('online')
                    @elseif(!empty($user->last_seen_at))
                        {{ $user->last_seen_at->diffForHumans() }}
                    @else
                        @langucw('never logged in')
                    @endif
                </a>
            </li>
            <li class="list-group-item">
                <b>@langucw('email verified')</b>
                <a class="float-right">
                    @if($user->isEmailVerified())
                        <i class='fas fa-check' style='color: green;'></i>
                    @else
                        <i class='fas fa-times' style='color: red;'></i>
                    @endif
                </a>
            </li>
        </ul>
        <strong><i class="fas fa-map-marker-alt mr-1"></i> ZoneID</strong>
        <p class="text-muted">{{ $user->zone? $user->zone->region['name_'. strtolower(getLang())] ." - ". $user->zone->getTitle():"" }}</p>


    </div>
    <!-- /.card-body -->
</div>


