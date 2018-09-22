<?php

namespace app\models;

use Components\extension\models\models;




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

    public static function getTovars($id)
    {
         return self::select()->in('lid', 'WHERE',$id)->andWhere('id_lang',lang())->get();
    }

}