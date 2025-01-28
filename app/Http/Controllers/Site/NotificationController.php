<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;


use App\Http\Requests\Site\ListLatestUnreadNotificationsInHtmlRequest;
use App\Interfaces\RepositoryInterface;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\View;


class NotificationController extends Controller
{
    public function __construct(RepositoryInterface $notificationRepo)
    {
        $this->notificationRepo = $notificationRepo;

    }
    public function index(Request $request)
    {


        $notifications = $this->notificationRepo->getUserNotifications(getLogged());

        return view('site.notification.index', [
            'notifications' => $notifications,
        ]);
    }
    public function getLatestUnreadNotificationsInHtml(ListLatestUnreadNotificationsInHtmlRequest $request){
        $user = getLogged();

        $notifications = $this->notificationRepo->getLatestUnreadNotifications($user, $request->after_date, $request->exclude_idsnull) ;
        $notificationsHtml = '';
        foreach ($notifications as $notification) {
            $notificationsHtml .= View::make('components.notification-item', [
                'notification' => $notification,
            ])->render();
        }

        foreach ($notifications as $notification) {
            $includedIds[] = $notification['id'];
        }
        $response = [
            'notifications' => $notificationsHtml,
            'unread_count' => $user->unreadNotifications()->count(),
            'ids' => $includedIds ?? null,
        ];

        return $response;
    }
    public function markAllAsRead()
    {

        getLogged()->notification->markAsRead();

        return redirect()->back()->with('message', __('all notifications marked as read successfully'));
    }




}
