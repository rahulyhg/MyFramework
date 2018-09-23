<?php


namespace app\models;

use Components\extension\models\models;

/**
 * Class lang
 * @package app\models
 */

class lang extends models
{

    private static $langs;

    /**
     * @return array
     */
    public static function getLang(): array
    {
        if(empty(self::$langs)){
            self::$langs = self::where('visible', 1)->get();
        }
        return self::$langs;
    }

    /**
     * @return array
     */
    public static function getGlobalsVaribleLang(): array
    {
        return [
            'arr_lang' => self::getLang()
        ];
    }

}