<?php

namespace app\models;

use Components\db\models;

class menu extends  models
{

    public static function getMenuCatalog()
    {
        return self::where('lang',lang())->get();
    }




}