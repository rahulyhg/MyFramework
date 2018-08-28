<?php

namespace app\models;

use Components\db\models;




class tovars extends models
{

    public static function getAllTovarsWithMailSettings(array $id)
    {
        return self::where('id_lang',lang())->in('lid','and',$id)->get();
    }


    public static function getLastTenTovars()
    {
        return self::where('id_lang',lang())->order()->limit(6)->get();
    }

}