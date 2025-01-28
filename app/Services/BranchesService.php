<?php

namespace App\Services;

use App\Models\Branche;
use Illuminate\Support\Facades\Cache;

;

class BranchesService
{
    public static function storeFromRequest($request)
    {
        $data = [
            'AddresAr' => $request->AddresAr,
            'AddresEn' => $request->AddresEn,
            'Phone' => $request->Phone,
            'Map' => $request->Map,
            'blob' => $request->blob,
        ];
        $entity = new Branche($data);
        $entity->save();
        return $entity;
    }

    public static function updateFromRequest($entity, $request)
    {

        $data = [
            'AddresAr' => $request->AddresAr,
            'AddresEn' => $request->AddresEn,
            'Phone' => $request->Phone,
            'Map' => $request->Map,
        ];
        $entity->update($data);
        $entity->save();
        return $entity;
    }

    public static function getOurBranches()
    {
        return Cache::remember('OurBranches', 86400, function () {
            return Branche::select('*')->get();
        });

    }
    public static function getFirstBracheLocation(){
        $branch=self::getOurBranches()->first();
        if($branch){
            return $branch->Map;
        }
        return '';
    }
    public static function getFirstBracheName(){
        $branch=self::getOurBranches()->first();
        if($branch){
            return $branch->getTitle();
        }
        return '';
    }
    public static function getFirstBrache(){
        $branch=self::getOurBranches()->first();
        if($branch){
           return $branch->id;
        }
        return 0;
    }
}
