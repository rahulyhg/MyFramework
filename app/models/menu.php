<?php

namespace app\models;

use Components\extension\models\models;

class menu extends  models
{

    public static function getMenuCatalog()
    {
        return self::where('lang',lang())->get();
    }




}