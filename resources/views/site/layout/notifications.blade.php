{{-- notifications --}}
@php
    if(isLogged()){
        $unreadNotificationsCount = getLogged()->unreadNotifications()->count();
        $latestNotifications = app()->make(\App\Repositories\NotificationRepository::class)->getLatestNotifications(getLogged());
    }
@endphp

<div class="notifactions-list-drop" style="display: none">
    <span class="wrapper-arrow"></span>
    <div class="wrapper-header">
        <div class="row">
            <div class="col-6 drop-title">@langucw('notifications')</div>
            <div class="col-6"><a href="{{route('notifications.mark_all_as_read')}}" class="border-btn" type="button">@langucw('mark all as read')</a></div>
        </div>
    </div>
    <div class="wrapper-body">
        <div class="note-lis">
            @foreach ($latestNotifications ?? [] as $notification)
                @include('components.notification-item')
            @endforeach
        </div>
    </div>
    <div class="wrapper-footer">
        <a href="{{ route('notifications.index') }}" class="border-btn-wide" type="button">@langucw('list all notifications')</a>
    </div>
</div>







