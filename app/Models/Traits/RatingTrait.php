<?php

namespace App\Models\Traits;

use App\Models\Rating;

trait RatingTrait
{
    public function rating()
    {
        return $this->hasMany(Rating::class,'UserID');
    }
    public function hasRated($entity){
        return $this->rating()->where('ItemID',$entity->id)->exists();
    }
    public function getRate($entity){
        return $this->rating()->where('ItemID',$entity->id)->rate;
    }

}
