<?php

namespace App\Models\Traits;

use App\Models\UserOccasion;

trait UserOccasionTrait
{
    public function userOccasion(){
        return $this->hasMany(UserOccasion::class,'UserID');
    }
}
