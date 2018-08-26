<?php

namespace app\models;

use Components\db\models;


class main extends models
{

    private static $main_settings;

    public static function tovarIdWithMainSettings()
    {
        return  explode(',',self::getAllMainSettings()['products']['all']);
    }


    public static function getAllMainSettings()
    {
        if (empty($main_settings)) {
            self::$main_settings = self::all()[0];
            self::$main_settings['products'] = json_decode(self::$main_settings['products'], true);
        }
        return self::$main_settings;
    }


}