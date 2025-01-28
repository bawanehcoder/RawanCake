<?php

namespace App\Models\Traits;

use App\Services\ToastNotificationService;

trait ToastNotificationTrait
{
    public function sendToast($msg, $type){
        ToastNotificationService::sendToast($user = $this, $msg, $type);
    }
}
