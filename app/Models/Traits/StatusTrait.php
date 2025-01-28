<?php

namespace App\Models\Traits;

trait StatusTrait
{
    public static function getStatusCodeByName($fieldName, $statusName)
    {
        $varContainingMapping = self::$fieldStatusMapping[$fieldName];
        foreach (self::$$varContainingMapping as $key => $item) {
            if ($item['codeName'] == $statusName) {
                return $key;
            }
        }
    }
    public static function getStatusNameByCode($fieldName, $statusCode)
    {
        $varContainingMapping = self::$fieldStatusMapping[$fieldName];
        return self::$$varContainingMapping[$statusCode]['codeName'];
    }
    public function getStatusName($fieldName)
    {
        return self::getStatusNameByCode($fieldName, $this->$fieldName);
    }
}
