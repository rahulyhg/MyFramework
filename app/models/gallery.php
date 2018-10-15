<?php

namespace app\models;

use Components\extension\models\models;

class gallery extends models
{
    public static function getPhoto(string $lid): array
    {
        return self::select('img')->where('lid',$lid)->get();
    }
}