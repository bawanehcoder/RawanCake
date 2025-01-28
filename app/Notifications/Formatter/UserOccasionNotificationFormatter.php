<?php

namespace App\Notifications\Formatter;

use App\Classes\NotificationFormatterBase;

class UserOccasionNotificationFormatter extends NotificationFormatterBase
{
    public function __construct(public $entity)
    {

    }

    public function getTitle()
    {
        return __('occasion'). $this->entity['title' ];
    }

    public function getContent()
    {
        return __('occasion')."  ". $this->entity['title' ]."  ".$this->entity['date' ];
    }
    public function getSender(){
        return $this->entity;
    }
    public function getSenderName()
    {
        return @langucw('rawan');
    }
    public function getRedirectUrl()
    {
        return route('user_occasions.index');
    }

    public function isFromAdmin(){

        return true;
    }
    public function getSenderAvatar()
    {
        return '/site/assets/images/logo.png';
    }
}
