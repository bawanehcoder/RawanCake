<?php

namespace App\Models\Traits;

use App\Models\UserFavorite;

trait FavoriteTrait
{
    public function userFavorite(){
        return $this->hasMany(UserFavorite::class,'UserID');
    }
    public function hasFavorite($entity)
    {
        return $this->userFavorite()->where('ItemID',$entity->id)->exists();
    }
    public function getFavorite($entity)
    {
        return $this->userFavorite()->where('ItemID',$entity->id)->first();
    }
//    public function isFavorite(){
//        if(getLogged()){
//            return UserFavorite::where('UserID',getLogged()->id)->where('ItemID',$this->id)->exists();
//        }
//        return false;
//    }
}
