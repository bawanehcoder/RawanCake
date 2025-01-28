<?php

namespace App\Classes;

class UrlHelpers
{
    public static function encodeUrl($url)
    {
        $url = urlencode($url);
        $url = str_replace(['%3A', '%2F'], [':', '/'], $url);
        return $url;
    }

    /**
     * Check if given url exists and not returing 404
     * @param string $url
     * @return boolean
     */
    public static function isUrlAccessable($url)
    {
        return substr(get_headers($url)[0], 9, 3) == 200;
    }

    /**
     * Check if given string is valid url
     * @param string $url
     * @return boolean
     */
    public static function isValidUrl($url)
    {
        return self::isRelativeUrL($url) || self::isAbsoluteUrl($url);
    }

    /**
     * Check if given string is relative or absoulte url
     * @param string $url
     * @return boolean
     */
    public static function isRelativeUrL($url)
    {
        return preg_match("/^\//", $url);
    }

    /**
     * Check if given string is absolute url
     * @param string $url
     * @return boolean
     */
    public static function isAbsoluteUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * Check if given url related to side running on eists
     * @param string $relativeUrl: /image/img.jpg
     * @return boolean
     */
    public static function isLocalUrlAccessable($relativeUrl)
    {
        if (!self::isRelativeUrL($relativeUrl)) {
            throw new \Exception("Given absolute url instead if relative one.", 1);
        }

        $absoluteUrl = asset($relativeUrl);
        return self::isUrlAccessable($absoluteUrl);
    }

    /**
     * Convert given relative url to absolute url
     * @param string $url
     * @param string $baseUrl
     * @return string $url
     */
    public static function convertRelativeToAbsolute($url, $baseUrl){
        return $baseUrl . $url;
    }

    /**
     * Convert given absolute url to relative url
     * @param string $url
     * @return string $url
     */
    public static function convertAbsoluteToRelative($url){
        if(self::isRelativeUrL($url)) return $url;
        $parts = parse_url($url);
        $url = '';
        $url .= !empty($parts['path']) ? $parts['path'] : '';
        $url .= !empty($parts['query']) ? '?' . $parts['query'] : '';
        return $url;
    }

    /**
     * check if given url is internal(belong) to given baseUrl
     * @param string $url
     * @param string $baseUrl
     * @return booelan
     */
    public static function isUrlOnTheSameDomain($url, $domain){
        if(self::isRelativeUrL($url)) return true;

        //extract host domain for givenUrl and domain, delete (www.), then compare
        return ltrim( parse_url($url, PHP_URL_HOST), 'www.') == ltrim( parse_url($domain, PHP_URL_HOST), 'www.');
    }

    /**
     * Remove query params from given url
     * @param string $url
     * @return string $url
     */
    public static function removeQueryParamsFromUrl($url){
        $parts = parse_url($url);
        $url = '';

        //add schema if exists
        $url = !empty($parts['scheme']) ? $parts['scheme'] . '://' : '';

        //add host if exists
        $url .= !empty($parts['host']) ? $parts['host'] : '';

        //add path if exists
        $url .= !empty($parts['path']) ? $parts['path'] : '';

        return $url;
    }

    /**
     * Get Base url from given url. example: given(https://www.users.google.com?x=1) , return google.com
     * @param string $url
     * @return string $url
     */
    public static function getBaseUrl($url){
        if(!self::isValidUrl($url)){
            throw new \Exception("Given url is not valid", 1);
        }
        $host = parse_url($url, PHP_URL_HOST);
        $parts = explode('.', $host);
        $topLevelDomain = end($parts);
        $baseName = prev($parts);
        return $baseName . '.' . $topLevelDomain;
    }

    public static function getQueryParamsFromUrl($url){
        if(empty(parse_url($url)['query'])){
            return [];
        }

        $params = explode('&', parse_url($url)['query']);

        $final = [];
        foreach ($params as $param) {
            $final[explode('=', $param)[0]] = explode('=', $param)[1];
        }

        return $final;
    }
}
