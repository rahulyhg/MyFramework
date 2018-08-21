<?php


namespace Components\extension;

use Components\db\models;

class siteSettings
{

    public static $settings = [];

    public static function creatSettings()
    {
        self::$settings = models::siteSettings()->all()[0];
    }

}