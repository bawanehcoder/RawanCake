<?php

namespace App\Services;

use App\Models\Point;


class PointsService
{
    public static function charge($user,$amount, $details = null){
        $point = Point::create([
            'amount' => $amount,
            'user_id' => $user->id,
            'balance' => $user->totalPoints() + $amount,
            'details' => $details,
            'blob' => 'points',
        ]);
        $msg = __('you have earned :numberOfPoints points for :action', ['numberOfPoints' => trans_choice(':numberOfPoints points', $amount, ['numberOfPoints' => $amount]), 'action' => str_replace('_', ' ', $details)]);
        $user->sendToast($msg = $msg, $type = 'success');
        return $point;
    }

}
