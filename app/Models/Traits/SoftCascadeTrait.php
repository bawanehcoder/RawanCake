<?php

namespace App\Models\Traits;

trait SoftCascadeTrait
{
    public function getSoftCascade()
    {
        if (!property_exists($this, 'softCascade')) {
            return [];
        }

        return $this->softCascade;
    }
}
