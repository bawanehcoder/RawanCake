<?php

namespace App\Services;

class NotificationsMappingLoader
{
    protected $mapping = [];

    public function __construct(){
        $this->getMapping();
    }

    /**
     * for each module, get its notifications mapping array
     * @return array
     */
    public function getMapping(){
        $mapping = [];
        $path = base_path( '/app/Notifications/NotificationsMapping.php');
        $mapping = array_merge($mapping, include($path));
        $this->mapping = $mapping;

    }

    public function getFormatter($notificationType){

        return  $this->mapping[$notificationType];


    }
}
