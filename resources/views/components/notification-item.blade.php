<div class="note-item">
    <div class="row">
        <div class="col-3">
            <img src="{{$notification['senderAvatar']}}" class="img-fluid"/>
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-3 note-name">{{ ucwords($notification['senderName']) }}</div>
                <div class="col-9 note-time "><i
                        class="fa fa-clock"></i>{{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}
                </div>
            </div>
            <a href="{{ $notification['redirectUrl'] }}">
                <p>{!! $notification['content'] !!} </p>
            </a>
        </div>
    </div>

</div>


