<?php

namespace App\Services;

use App\Exceptions\DuplicateElementException;
use App\Models\OptionDetil;

class OptionDetilService
{

    public static function storeFromRequest($entity,$request)
    {

        $data = [
            'OptID' => $request->OptID,
            'blob' => $request->blob,
            'ItemID' => $request->id,
            'POptID' => $request->MainID,
            'AdditionalValue' => $request->AdditionalValue??1,
        ];
        try{
            $entity=new OptionDetil($data);
            $entity->save();
            return $entity;
        }catch (\Exception $ex){

            throw new DuplicateElementException();
        }

    }

    public static function updateFromRequest($entity,$request)
    {
        $data = [
            'OptID' => $request->OptID,
            'POptID' => $request->MainID,
            'AdditionalValue' => $request->AdditionalValue??1,
        ];
        $entity->update($data);
        $entity->save();

        return $entity;
    }
}
