<?php

namespace app\models;

use Components\db\models;

/**
 * Class main
 * @package app\models
 */

class main extends models
{

    /**
     * @var array
     */

    private static $main_settings;


    /**
     * @return array
     */


    public static function tovarOurProductsIdWithMainSettings()
    {
        return  explode(',',self::getAllMainSettings()['products']['data']['all']);
    }


    public static function tovarOnSaleIdWithMainSettings()
    {
        return  explode(',',self::getAllMainSettings()['on_sale']['data']['id']);
    }

    /**
     * @return array
     */


    public static function getAllMainSettings()
    {
        if (empty($main_settings)) {

            self::$main_settings = self::changeKeyArr(self::all(),'data');

        }
        return self::$main_settings;
    }

}
