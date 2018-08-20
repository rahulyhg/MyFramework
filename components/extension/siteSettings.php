<?php
/**
 * Created by PhpStorm.
 * User: egor
 * Date: 20.08.18
 * Time: 18:01
 */

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