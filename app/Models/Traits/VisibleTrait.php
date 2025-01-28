<?php

namespace App\Models\Traits;

trait VisibleTrait
{
    public function getVisibleAttribute($value)
    {
        switch ($value) {
            case 0:
                return 'invisible';
            case 1:
                return 'visible';

        }
    }
}
