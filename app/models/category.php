<?php

namespace app\models;

use Components\extension\models\models;

class category extends models
{
    private static $category;



    private static $child = [];



    public static function getCategory()
    {
        return empty(self::$category) ? self::$category = self::where('lang', lang())->get() : self::$category;
    }


    public static function childCategory(int $lid)
    {
        $allCategory = self::getCategory();

        foreach ($allCategory as $key => $value) {
            if ($value['parent'] == $lid) {
                self::$child[] = $value['lid'];
                self::childCategory($value['lid']);
            }
        }

        self::$child[] = $lid;

        return array_unique(self::$child);
    }


}