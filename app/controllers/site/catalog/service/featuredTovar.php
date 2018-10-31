<?php

namespace app\controllers\site\catalog\service;

use app\models\main;
use app\models\tovars;

class featuredTovar
{
    public static function get(): array
    {
        $id = main::getAllMainSettings('products')['featured'];
        $tovars = tovars::getAllTovarsWithMailSettings(main::tovarOurProductsIdWithMainSettings());
        return array_chunk(self::getFeaturedTovarBanner($tovars, $id), 3);
    }

    private static function getFeaturedTovarBanner(array $tovars, string $id, array $featuresTovar = []): array
    {
        foreach ($tovars as $key => $value) {
            if (preg_match("~{$value['lid']}~", $id)) {
                $featuresTovar[] = $value;
            }
        }
        return $featuresTovar;
    }
}