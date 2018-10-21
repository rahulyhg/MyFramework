<?php

namespace app\models;

use Components\extension\models\models;

/**
 * Class tovars
 * @package app\models
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * currency() - ТАМ ЯКЩО ДОЛАРИ нЕ ВСЕ SELECT
 */
class tovars extends models
{

    protected const COUNT_PAGE = 15;


    public static function getAllTovarsWithMailSettings(array $id)
    {
        return self::currency()->where('id_lang', lang())->in('lid', 'and', $id)->get();
    }


    public static function getLastTenTovars()
    {
        return self::currency()->where('id_lang', lang())->order()->limit(6)->get();
    }

    public static function getTovars(array $id)
    {
        return self::currency()->in('lid', 'WHERE', $id)->andWhere('id_lang', lang())->get();
    }

    public static function getTovar($id)
    {
        return self::currency()->where('lid', $id)->andWhere('id_lang', lang())->get();
    }

    
    public static function tovarsWithFilterPrice(string $data, string $column, array $filterPrice, $cat)
    {

        $count = self::countTovarsWithFilterPrice($filterPrice, $cat);

        return self::currency()->where(['id_lang' => lang()])
            ->in('category', ' and ', $cat)
            ->andWhere('price', $filterPrice['from'], '>', false)
            ->andWhere('price', $filterPrice['to'] + 1, '<', false)
            ->order($data, $column)
            ->pagination(self::countPage(), $count)->get();
    }


    private static function countTovarsWithFilterPrice(array $filterPrice, $cat)
    {
        return self::where(['id_lang' => lang()])
            ->in('category', ' and ', $cat)
            ->andWhere('price', $filterPrice['from'], '>', false)
            ->andWhere('price', $filterPrice['to'] + 1, '<', false)
            ->count()->get()[0]['count'];
    }



    public static function getAllTovars(string $data, string $column, $cat = [])
    {
        $count = self::countTovars($cat);
        return self::currency()->where(['id_lang' => lang()])
            ->in('category', ' and ', $cat)
            ->order($data, $column)->pagination(self::countPage(),$count)->get();
    }

    public static function getRandomTovarsInCategory(int $id): array
    {
        return self::currency()->where(['category' => $id,'id_lang' => lang()])->random()->limit(9)->get();
    }

    public static function randomTovars(int $limit = 15): array
    {
        return self::currency()->where('id_lang',lang())->random()->limit($limit)->get();
    }

    private static function countTovars($cat)
    {
        return self::where(['id_lang' => lang()])
            ->in('category', ' and ', $cat)
            ->count()->get()[0]['count'];
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

    public static function randomActionTovar(): array
    {
        return self::currency()->where('id_lang',lang())->andWhere('old_price','1','>')->random()->limit(1)->get();
    }



}