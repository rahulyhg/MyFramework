<?php
/**
 * Created by PhpStorm.
 * User: egor
 * Date: 19.08.18
 * Time: 18:54
 */

namespace components\extension;


class multiLang
{
    private static $const = [];

    public static function prefs($cnst)
    {
        if(empty(self::$const)){
            self::addToConst();
        }

        self::$const[$cnst];
    }

    public function addToConst(): void
    {
        self::$const = require_once 'app/constants/'.session('lang.domen').'/const.php';
    }


}