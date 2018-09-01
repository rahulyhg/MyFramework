<?php

namespace app\models;

use Components\db\models;
use Components\extension\arr\Request;
use Components\extension\graphics;


/**
 * Class main
 * @package app\models
 */

class main extends models
{

    /**
     * @var array
     */

    private static $main_settings;


    /**
     * @return array
     */


    public static function tovarOurProductsIdWithMainSettings()
    {
        return  explode(',',self::getAllMainSettings()['products']['data']['all']);
    }


    public static function tovarOnSaleIdWithMainSettings()
    {
        return  explode(',',self::getAllMainSettings()['on_sale']['data']['id']);
    }


    /**
     * @param string $key
     * @return array|mixed
     */

    public static function getAllMainSettings(string $key = '')
    {
        if (empty($main_settings)) {

            self::$main_settings = self::changeKeyArr(self::all(),'data');

        }
        return $key == '' ? self::$main_settings : self::$main_settings[$key]['data'];
    }

    public static function saveRequest(array $request)
    {
        self::update(['data' => json_encode(['id' => $request['on_sale']])])->where('id','on_sale')->save();

        $request['products']['all'] = self::createAllProducts($request['products']);

        self::update(['data' => json_encode($request['products'])])->where('id','products')->save();

    }


    private static function createAllProducts(array $arr,array $result = [])
    {
        foreach ($arr as $key => $value){
            $result[] = $value;
        }
        return implode(',',$result);
    }


    public static function saveAboutSite($request)
    {
        $request['img'] = !empty($_FILES['img']['name']) ? graphics::img()->maxSizeImg(400, 300)->save() : $request['old_img'];

        self::update(['data' => json_encode($request)])->where('id','about_site')->save();
    }

}
