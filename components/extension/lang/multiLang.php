<?php

namespace Components\extension\lang;


use Components\extension\infoPages\error_page;

class multiLang
{
    private static $const = [];

    public static function prefs($cnst,$description = '')
    {
        if(empty(self::$const)){
            self::addToConst();
        }
        return self::$const[$cnst] ?? error_page::showPageError('Not found const '.$cnst,'code #34t3y34bo');
    }

    public  static function addToConst(): void
    {
        self::$const = require 'app/constants/'.session('lang.domen').'/const.php';
    }


}