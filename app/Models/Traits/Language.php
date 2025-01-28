<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Config;

trait Language
{
    public function getLang(){
        return Config::get('app.locale');
    }
}
