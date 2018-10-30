<?php

namespace app\models;

use Components\extension\models\models;

class starRating extends models
{
    public static function getAvgRating(): float
    {
        return self::select()->avg('rating')->get()[0]['avg'] ?? 0;
    }
}

