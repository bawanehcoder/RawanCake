<?php

namespace App\Services;

use App\Models\UserFavorite;
use Illuminate\Http\Response;

class UserFavoriteService
{
    public static function storeFromRequest($favorite)
    {
        try {
            $data = [
                'UserID' => getLogged()->id,
                'ItemID' => $favorite->id
            ];
            $entity = new UserFavorite($data);
            $entity->save();
            return Response::HTTP_OK;
        } catch (\Exception $ex) {
            return Response::HTTP_INTERNAL_SERVER_ERROR;
        }
    }
}
