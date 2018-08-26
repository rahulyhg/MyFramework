<?php


namespace app\models;

use Components\db\models;


class lang extends models
{

    public static function getLang(): array
    {
        return self::where('visible',1)->get();
    }

    public static function getGlobalsVaribleLang(): array
    {
        return [
            'arr_lang' => self::getLang()
        ];
    }

}