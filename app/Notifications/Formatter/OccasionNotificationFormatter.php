<?php

namespace App\Notifications\Formatter;

use App\Classes\NotificationFormatterBase;

class OccasionNotificationFormatter extends NotificationFormatterBase
{
    public function __construct(public $entity)
    {

    }

    public function getTitle()
    {
        return $this->entity['title_ar' ];
    }

    public function getContent()
    {

        return $this->entity['description_ar' ];
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
        return 'kkkkk';
    }

    public function isFromAdmin(){

        return true;
    }
    public function getSenderAvatar()
    {
        return '/assets/images/uncle-kafiil/default.png';
    }
}
