<?php

namespace app\models;

use Components\extension\models\models;


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
        return self::pdo_query("SELECT if(ROUND(AVG(`rating`),1) is NULL,0,ROUND(AVG(`rating`),1)) `avg`, `t`.* FROM `tovars` `t`
                                 LEFT JOIN `starRating` `s` ON `t`.`lid` = `s`.`lid` 
                                 WHERE `t`.`lid` = ? AND `id_lang` = ?",[$id,lang()]);
    }


    public static function tovarsWithFilterPrice(string $data, string $column, array $filterPrice, $cat)
    {

        $in = self::sqlOn($cat);

       return self::pdo_query("SELECT if(ROUND(AVG(`rating`),1) is NULL,0,ROUND(AVG(`rating`),1)) `avg`,
                                     `tovars`.* 
                                    FROM `tovars` LEFT JOIN `starRating` ON `tovars`.`lid` = `starRating`.`lid` 
                                    WHERE `id_lang` = ? AND `price` > ? AND `price` < ? {$in}
                                    GROUP BY `lid` ORDER BY `tovars`.`{$column}` {$data}" .
                            self::sqlPagination(self::countPage(), self::countTovarsWithFilterPrice($filterPrice, $in)),
             [lang(),$filterPrice['from'],$filterPrice['to'] + 1]);
    }

    private static function countTovarsWithFilterPrice(array $filterPrice, $cat)
    {
        $in = self::sqlOn($cat);
        return self::pdo_query("SELECT COUNT(`lid`) as `count` FROM `tovars` WHERE `id_lang` = ? 
                        AND `price` > ? AND `price` < ? {$in} ",[lang(),$filterPrice['from'],$filterPrice['to'] + 1])[0]['count'];
    }

    private static function sqlOn($cat)
    {
        if ($cat) {
            $cat = implode("','", $cat);
            return "and `category` IN('{$cat}')";
        }
        return '';
    }

    public static function getAllTovars(string $data, string $column, $cat = [])
    {
       $on = self::sqlOn($cat);

        return self::pdo_query("SELECT if(ROUND(AVG(`rating`),1) is NULL,
                            0,ROUND(AVG(`rating`),1)) `avg`, `tovars`.* 
                            FROM `tovars` 
                            LEFT  JOIN `starRating`  ON   `tovars`.`lid` = `starRating`.`lid` 
                            WHERE `id_lang` = ? {$on} GROUP BY `lid`  
                            ORDER BY `tovars`.`{$column}` {$data}" .
                            self::sqlPagination(self::countPage(), self::countTovars($on)), [lang()]);

    }

    private static function countTovars($on)
    {
        return self::pdo_query("SELECT COUNT(`lid`) `count` FROM `tovars` WHERE `id_lang` = ? {$on} ", [lang()])[0]['count'];
    }

    public static function getRandomTovarsInCategory(int $id): array
    {
        return self::rating()->where(['category' => $id, 'id_lang' => lang()])->group('lid')->random()->limit(9)->get();
    }

    public static function randomTovars(int $limit = 15): array
    {
        return self::rating()->where(['tovars' => ['id_lang' => lang()]])->group('lid')->random()->limit($limit)->get();
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