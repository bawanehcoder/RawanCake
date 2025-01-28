<?php

namespace App\Services;
use \Illuminate\Support\Facades\Redis;
class ToastNotificationService
{
    public static function sendToast($user, $msg, $type){
        $cacheKey = self::getCacheKey($user);
        //save toast to cache of user
        // Redis::command('lpush', [$cacheKey, json_encode([
        //     'msg' => $msg,
        //     'type' => $type,
        // ])]);
    }
    public static function pullToastMsg($user){
        $cacheKey = self::getCacheKey($user);
    //    return Redis::lpop($cacheKey);
    }
    private static function getCacheKey($user){
        return 'toast_msgs:users'  . $user->id;
    }
}
