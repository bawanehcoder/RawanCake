<?php

use Modules\Comment\Services\BannedWordsService;
#last-updated: 28-12-2019


function isTextContains($text, $find, $caseSensitive = true){
    if($caseSensitive){
        return (mb_strpos($text, $find) !== false);
    }
    return (mb_stripos($text, $find) !== false);
}



/**
 * Remove break lines, replace it with spaces
 * @param string $text
 * @return string
 */
function removeBreakLines($text){
    return str_replace("\r\n", ' ', $text);
}

function formatDescription($description){
    $desc = removeBreakLines($description);
    $desc = mb_substr( trim($desc), 0, 50 );
    return $desc;
}


function appendToClass($path, $text){
    $content = file_get_contents($path);

    //extract part of class that allow us to append after
    $pattern = "/class.+{/Us";
    preg_match_all($pattern, $content, $results);
    $appendAfter = $results[0][0];


    //start replace
    $pattern = '/' . $appendAfter . '/';
    $replaceWith = $appendAfter . "\r\n" . '    ' . $text;
    $newContent = preg_replace($pattern, $replaceWith, $content);
    file_put_contents($path, $newContent);
}

function filterBannedWordsIfExists($obj, $attr){
    if(!$obj->has_banned_words){
        return $obj->$attr;
    }
    return BannedWordsService::encodeBannedWords($obj->$attr);
}
