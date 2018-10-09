<?php

namespace app\models;

use Components\extension\models\models;




class tovars extends models
{

    protected const COUNT_PAGE = 15;


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

    /**
     * @param string $data
     * @param string $column
     * @param array $price
     * @param int $cat
     * @return array
     * NEEEEEEEEEEEEEDDDDDDDDDDDD REFCODING!!!!!!!!!!!!!!!1
     */
    public static function getAllTovars(string $data, string $column,array $price = [],int $cat = 0)
    {
        $where = ['id_lang' => lang()];

        if($cat){
            $where['category'] = $cat;
        }

        if($price){
            $count = self::where($where)->count()->get()[0]['count'];
            return self::currency()->where($where)
                ->andWhere('price',$price['from'],'>',false)
                ->andWhere('price',$price['to']+1,'<',false)
                ->order($data,$column)->pagination(self::countPage(),$count)->get();
        }else{
            $count = self::where($where)->count()->get()[0]['count'];
            return self::currency()->where($where)->order($data,$column)->pagination(self::countPage(),$count)->get();
        }
    }

    private static function countPage()
    {
        return $_SESSION['catalog']['view'] ?? self::COUNT_PAGE;
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