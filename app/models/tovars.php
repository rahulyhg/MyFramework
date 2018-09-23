<?php

namespace app\models;

use Components\extension\models\models;




class tovars extends models
{

    protected const COUNT_PAGE = 10;


    public static function getAllTovarsWithMailSettings(array $id)
    {
        return self::currency()->where('id_lang',lang())->in('lid','and',$id)->get();
    }


    public static function getLastTenTovars()
    {
        return self::currency()->where('id_lang',lang())->order()->limit(6)->get();
    }

    public static function getTovars($id)
    {
         return self::currency()->in('lid', 'WHERE',$id)->andWhere('id_lang',lang())->get();
    }

    public static function getAllTovars()
    {
        $count = self::select()->count()->get();

        return self::currency()->where('id_lang',lang())->order()->pagination(self::COUNT_PAGE,$count[0]['count'])->get();
    }

    private static function currency()
    {
        if (session('currency') == '₴') {
            return self::select();
        } else {
            return self::select(['id', 'lid', 'name', 'created', 'id_lang', 'img', 'old_price_doll', 'price_doll', 'action'])
                ->as('old_price_doll', 'old_price')->as('price_doll', 'price');
        }
    }

}