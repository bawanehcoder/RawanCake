<?php

namespace App\Models\Traits;

trait TranslateValidationErrorAttributesTrait
{
    public function getValidatorInstance()
    {
        foreach (array_keys($this->rules()) as $input) {
            $newInputs[$input] = __(str_replace('_', ' ', $input));
        }
        return parent::getValidatorInstance()->addCustomAttributes($newInputs ?? []);
    }
}
