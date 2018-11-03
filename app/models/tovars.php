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


    public static function getAllTovarsWithMailSettings(array $id): array
    {
        return self::rating()->where(['tovars' => ['id_lang' => lang()]])
            ->in('lid', 'and', $id, 'tovars')
            ->group('lid')->get();
    }


    public static function getLastTenTovars()
    {
        return self::rating()->where(['tovars' => ['id_lang' => lang()]])->group('lid')->order()->limit(6)->get();
    }

    public static function getTovars(array $id)
    {
        return self::rating()->in('lid', 'WHERE', $id, 'tovars')
            ->andWhere(['tovars' => ['id_lang' => lang()]])->group('lid')->get();
    }

    public static function getTovar($id)
    {
        return self::rating()->where(['tovars' => ['lid' => $id]])->andWhere('id_lang', lang())->get();
    }


    public static function tovarsWithFilterPrice(string $data, string $column, array $filterPrice, $cat)
    {

        $count = self::countTovarsWithFilterPrice($filterPrice, $cat);

        return self::rating()->where(['id_lang' => lang()])
            ->in('category', ' and ', $cat)
            ->andWhere('price', $filterPrice['from'], '>', false)
            ->andWhere('price', $filterPrice['to'] + 1, '<', false)
            ->group('lid')
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
        return self::rating()->where(['id_lang' => lang()])
            ->in('category', ' and ', $cat)
            ->group('lid')
            ->order($data, $column, 'tovars')
            ->pagination(self::countPage(), self::countTovars($cat))
            ->get();
    }

    public static function getRandomTovarsInCategory(int $id): array
    {
        return self::rating()->where(['category' => $id, 'id_lang' => lang()])->group('lid')->random()->limit(9)->get();
    }

    public static function randomTovars(int $limit = 15): array
    {
        return self::rating()->where(['tovars' => ['id_lang' => lang()]])->group('lid')->random()->limit($limit)->get();
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

    private static function rating()
    {
        return self::select(['tovars' => ['*']])->avg('rating')->leftJoin('starRating')
            ->On('lid', 'lid');
    }

    public static function randomActionTovar(): array
    {
        return self::rating()->where(['tovars' => ['id_lang' => lang()]])
            ->andWhere('old_price', '1', '>')
            ->group('lid')->random()->limit(1)->get();
    }


}