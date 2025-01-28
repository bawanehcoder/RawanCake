<?php

namespace App\Services;

use App\Models\GeneralInfo;
use Illuminate\Support\Facades\Cache;

class GeneralInfoService
{
    public static function updateFromRequest($request)
    {

        $entity=GeneralInfo::first();
        if($entity==null){
            $entity=new GeneralInfo($request->all());
            $entity->save();
        }else{
            $entity->update($request->all()) ;
            $entity->save();
        }
        return $entity;
    }
    public static function getGeneralInfo(){
//        $query = Cache::remember('GeneralInfo', 86400, function () {
//            return GeneralInfo::select('*')->first();
//        });
        $query =GeneralInfo::select('*')->first();
        return $query;
    }
}
