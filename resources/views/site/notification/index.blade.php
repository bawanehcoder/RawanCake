@extends('site.layout.master')
@section('title')
    @langucw('')
@endsection
@section('css') @endsection
@section('breadcrumb')
    <li><a href="{{route('home')}}">@langucw('home')</a></li>
    <li>@langucw('notifications')</li>
@endsection
@section('content')
    <div class="pad-top-150"></div>
    <div class="sidebars_widget ddd">
        <ul class="sidebars_widget__post ddd">
            <div class="container note-box">
                <span class="wrapper-arrow"></span>
                <div class="wrapper-header">
                    <div class="row">
                        <div class="col-6 drop-title"><i class="fa fa-bell"></i> @langucw('notifications')</div>
                        <div class="col-6"><a href="{{route('notifications.mark_all_as_read')}}" class="border-btn"
                                              type="button">@langucw('mark all as read')</a></div>
                    </div>
                </div>
                <div class="wrapper-body">
                    <div class="note-lis allow">
                        @foreach ($notifications ?? [] as $notification)

                            <div class="note-item">
                                <a href="{{ $notification->getRedirectUrl() }}" class="col-md-12">
                                    <div class="row">
                                        <div class="col-1">
                                            <img src="{{ $notification->getSenderAvatar() }}" class="img-fluid"/>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div
                                                    class="col-3 note-name">{{ ucwords($notification->getSenderName()) }}</div>
                                                <div class="col-9 note-time "><i
                                                        class="fa fa-clock"></i>{{ $notification->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                            <p>{!! $notification->getFormattedContent() !!}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>


        </ul>
    </div>

@endsection
@section('scripts') @endsection
