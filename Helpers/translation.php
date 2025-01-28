<?php

use Illuminate\Support\Facades\Config;

function langucw($expression, $params = []){
    if(\Config::get('app.locale') == 'ar'){
        return __($expression, $params);
    }
    // return ucwords($expression);
    return ucwords(__($expression, $params));
}

function langucf($expression, $params = []){
    if(\Config::get('app.locale') == 'ar'){
        return __($expression, $params);
    }
    // return ucfirst($expression);
    return ucfirst(__($expression, $params));
}

function languc($expression, $params = []){
    if(\Config::get('app.locale') == 'ar'){
        return __($expression, $params);
    }
    return strtoupper(__($expression, $params));
}
function getLang(){
    return ucwords(Config::get('app.locale'));
}
