<?php

namespace App\Models\Traits;

use App\Models\VtechUser;

trait VtechTrait
{
    public function vtechTrait()
    {
        return $this->hasOne(VtechUser::class, 'UserID');
    }
}
