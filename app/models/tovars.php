<?php

namespace app\models;

use Components\db\models;




class tovars extends models
{

    public static function getAllTovarsWithMailSettings()
    {
        $id = main::tovarIdWithMainSettings();
        return self::where('id_lang',lang())->in('lid','and',$id)->limit(10)->get();
    }

}