<?php

namespace App\Repositories;


use App\Interfaces\RepositoryInterface;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationRepository implements RepositoryInterface
{

    public function getAll()
    {
      return  Notification::all();
    }

    public function findById($id)
    {
        return Notification::findOrFail($id);
    }
    public function getLatestUnreadNotifications($user, $afterDate = null, $excludeIds = null){
        $query = $user->notification->whereNull('read_at');
        if($afterDate){
            $query = $query->where('created_at', '>=', $afterDate);
        };
        if($excludeIds){
            $excludeIds = array_filter($excludeIds, function($item){
                if($item){
                    return $item;
                }
            });
            $query = $query->whereNotIn('id', $excludeIds);
        };
        $notifications = $query;
        $formattedNotifications = [];
        foreach ($notifications as $notification) {
            $obj['id'] = $notification->id;
            $obj['created_at'] = $notification->created_at;
            $obj['isReaded'] = $notification->read_at ? true : false;
            $obj['content'] = $notification->getShortedFormattedContent();
           $obj['senderName'] = $notification->getSenderName();
            $obj['redirectUrl'] = $notification->getRedirectUrl();
            $obj['senderAvatar'] = $notification->getSenderAvatar();
            $obj['isFromAdmin'] = $notification->isFromAdmin();
            $formattedNotifications[] = $obj;
        }
        return $formattedNotifications;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
    public function getLatestNotifications($user){


        $notifications = $user->notification()->paginate(5);
        $formattedNotifications = [];
        foreach ($notifications as $notification) {
            $obj['id'] = $notification->id;
            $obj['created_at'] = $notification->created_at;
            $obj['isReaded'] = $notification->read_at ? true : false;
            $obj['content'] = $notification->getShortedFormattedContent();
            $obj['senderName'] = $notification->getSenderName();
            $obj['redirectUrl'] = $notification->getRedirectUrl();
            $obj['senderAvatar'] = $notification->getSenderAvatar();
            $obj['isFromAdmin'] = $notification->isFromAdmin();
            $formattedNotifications[] = $obj;
        }
        return $formattedNotifications;
    }
    public function getUserNotifications($user){
        $notifications = $user->notification()->paginate(20);

        $data = $notifications->getCollection()
            ->filter(function ($notification, $key) {
                return $notification;
            });


        $notifications->setCollection($data);

        return $notifications;




    }
}
