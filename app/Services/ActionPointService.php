<?php

namespace App\Services;

use App\Models\ActionPoint;

class ActionPointService
{
    public static function getActionPoint( $action){
        $action_point=ActionPoint::where('action',$action)->first();
        if($action_point){
            return $action_point->point;
        }
        return 0;
    }
}
