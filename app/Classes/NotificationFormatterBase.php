<?php

namespace App\Classes;

class NotificationFormatterBase
{
    public $notification;
    public $sender;



    public function getFormattedData(){

        return [
            'content' => $this->getContent(),
            'redirect_url' => $this->getRedirectUrl(),
            'sender_name' => $this->getSenderName(),
            'sender_avatar' => $this->getSenderAvatar(),
            'is_from_admin' => $this->isFromAdmin(),
        ];
    }

    public function getRedirectUrl(){
       return null;
    }

    public function getSender(){
        return null;
    }


    public function getSenderName(){
        if(empty($this->getSender())){
            return __(config('app.name'));
        }
        return $this->getSender()->name;
    }

    public function getSenderAvatar(){
        if(empty($this->getSender())){
            return config('notification.default_sender_avatar');
        }
        return $this->getSender()->avatar;
    }

    public function isFromAdmin(){
        if(empty($this->getSender())){
            return true;
        }
    }
}
