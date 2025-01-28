<?php

namespace App\Services;

class StringHelpers
{
    /**
     * @param $txt
     * @return mixed
     */
    public static function breaklinesToArray($txt)
    {
        $txt = explode("\r\n", $txt);
        $txt = array_filter($txt, function ($item) {
            if ($item !== '') {
                return $item;
            }

        });
        return $txt;
    }

    /**
     * @param $txt
     */
    public static function camelCaseStringToWords($txt)
    {

        return strtolower( implode(' ', preg_split('/(?=[A-Z])/', $txt)) );
    }

    /**
     * @param $input
     */
    public static function camelToSnake($input)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }

    /**
     * @param $base64
     * @return mixed
     */
    public static function filterBase64Date($base64)
    {
        $explodedData = explode('base64,', $base64);
        return $explodedData[1] ?? $explodedData[0];
    }

    /**
     * @param $txt
     */
    public static function filterDash($txt)
    {
        return str_replace('-', ' ', $txt);
    }

    /**
     * Generate db-unique username from given full name
     * @param  string   $fullName
     * @return string
     */
    public static function generateUsernameFromFullName($fullName, $guard = 'user')
    {
        //convert string to lowercase
        $fullName = strtolower($fullName);
        //remove any characters except (englishChars, -, .)
        $username = preg_replace('/[^a-z_]/', '', $fullName);

        //get object from user class to be used in
        $userClassName = getClassNameOfAlias($guard);
        $obj           = new $userClassName();

        //check in db if username taken
        $userNameTaken = $obj->where('username', $username)->exists();
        $i             = 1;
        while ($userNameTaken) {
            //change userName
            $i++;
            $suggestedUserName = $username . $i;
            $userNameTaken     = $obj->where('username', $suggestedUserName)->exists();
        }

        return $suggestedUserName ?? $username;
    }

    /**
     * @param $txt
     * @return mixed
     */
    public static function getCorrespondingBooleanTxt($txt)
    {
        if (in_array($txt, [0, '0', 'false', false])) {
            return 'no';
        } elseif (in_array($txt, [1, '1', 'true', true])) {
            return 'yes';
        }
        return $txt;
    }

    /**
     * Get first and last name from given fullName
     *  'firstName' => ....,
     *  'lastName' => .....
     * ]
     * @param  string $fullName
     * @return array  [
     */
    public static function getFirstAndLastNameFromFrullName($fullName)
    {
        $partsOfName = explode(' ', $fullName, 2);
        return [
            'firstName' => $partsOfName[0],
            'lastName'  => $partsOfName[1] ?? '',
        ];
    }

    /**
     * @param $data
     */
    public static function isBase64($data)
    {
        if (!is_string($data)) {
            return false;
        }
        $data = self::filterBase64Date($data);
        return base64_encode(base64_decode($data, true)) === $data;
    }

    /**
     * @param $text
     * @param $find
     */
    public static function isTextContains($text, $find)
    {
        $toFinds = is_array($find) ? $find : [$find];
        foreach ($toFinds as $toFind) {
            if ((mb_strpos($text, $toFind) !== false)) {
                return true;
            }

        }
    }

    /**
     * @param $text
     */
    public static function isTextContainsArabicChars($text)
    {
        if (preg_match('/[اأإء-ي]/', $text)) {
            return true;
        }
    }

    /**
     * @param $text
     */
    public static function isTextStartWithArabicChar($text)
    {
        $text = mb_substr($text, 0, 1);
        return self::isTextContainsArabicChars($text);
    }

    /**
     * @param $text
     */
    public static function isValidFirstName($text)
    {
        $pattern = '/^([a-zA-Z\. ]|[\p{Arabic}])+$/u';
        return preg_match($pattern, $text);
    }

    /**
     * Check if string is only (englishChars/numbers/_)
     * @param  string    $text
     * @return boolean
     */
    public static function isValidUsername($text)
    {
        return !preg_match('/[^a-zA-Z0-9_]/', $text);
    }

    /**
     * @param $input
     */
    public static function snakeToCamel($input)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $input))));
    }

    /**
     * Remove break lines, and shortcut text to specific length
     * @param  [type]  $text             [description]
     * @param  boolean $removeBreakLines [description]
     * @param  integer $trimTo           [description]
     * @return [type]                    [description]
     */
    public static function formatDescription($text, $removeBreakLines = true, $length = 250){
        if(!empty($length)){
            $text = mb_substr( trim($text), 0, $length );
        }
        $text =  htmlentities( $text );

        if($removeBreakLines){
            $text = removeBreakLines($text);
        }else{
            $text = nl2br($text);
        }

        //allow urls to be clickable
        $text = self::clickableUrls($text);

        return $text;
    }

    public static function formatDescriptionShowBannedWords($text, $removeBreakLines = true, $length = 250){
        if(!empty($length)){
            $text = mb_substr( trim($text), 0, $length );
        }
        $text =  htmlentities( $text );

        if($removeBreakLines){
            $text = removeBreakLines($text);
        }else{
            $text = nl2br($text);
        }


        return $text;
    }

    public static function clickableUrls($html){
        return $result = preg_replace(
            '%\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))%s',
            '<a rel="nofollow" class=\'theme-anchor\' href="$1">$1</a>',
            $html
        );
    }
}
