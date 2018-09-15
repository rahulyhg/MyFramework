<?php


namespace Components;

use Components\extension\models\models;

class siteSettings
{

    public static $settings = [];

    public static function creatSettings()
    {
      self::$settings = models::siteSettings()->all();

    }

}