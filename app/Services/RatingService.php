<?php

namespace App\Services;

use App\Models\Rating;
use Illuminate\Http\Response;

class RatingService
{
    public static function storeFromRequest($request,$entity)
    {
        try {
           $data=[
                   'rate'=>$request->rate,
                   'UserID'=>getLogged()->id,
                   'ItemID'=>$entity->id
               ];
            $entity = new Rating($data);
            $entity->save();
            return Response::HTTP_OK;
        } catch (\Exception $ex) {
            return Response::HTTP_INTERNAL_SERVER_ERROR;
        }
    }
}
