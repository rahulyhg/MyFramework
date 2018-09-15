<?php


namespace app\models;

use Components\extension\models\models;

/**
 * Class lang
 * @package app\models
 */

class lang extends models
{

    /**
     * @return array
     */
    public static function getLang(): array
    {
        return self::where('visible',1)->get();
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