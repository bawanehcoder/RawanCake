<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use App\Http\Requests\Site\ListLatestUnreadNotificationsInHtmlRequest;
use App\Interfaces\RepositoryInterface;
use App\Services\DiscountService;
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
        return responder()->success($notifications)->respond();

    }
    public function getLatestUnreadNotifications(ListLatestUnreadNotificationsInHtmlRequest $request){
        $user = getLogged();
        $notifications = $this->notificationRepo->getLatestUnreadNotifications($user, $request->after_date, $request->exclude_idsnull) ;
            foreach ($notifications as $notification) {
            $includedIds[] = $notification['id'];
        }
        $response = [
            'notifications' => $notifications,
            'unread_count' => $user->unreadNotifications()->count(),
            'ids' => $includedIds ?? null,
        ];

        return $response;
    }
    public function markAllAsRead()
    {
        getLogged()->notification->markAsRead();
        return responder()->success()->respond();
    }






}
