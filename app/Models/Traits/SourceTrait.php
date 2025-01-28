<?php

namespace App\Models\Traits;

trait SourceTrait
{
    public function getSourceAttribute($value)
    {
        switch ($value) {
            case 0:
                return 'Website';
            case 1:
                return 'IOS';
            case 2:
                return 'Andriod';
        }
    }
}
