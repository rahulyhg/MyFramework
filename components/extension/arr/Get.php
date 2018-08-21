<?php
/**
 * Created by PhpStorm.
 * User: egor
 * Date: 18.08.18
 * Time: 10:20
 */

namespace Components\extension\arr;


class Get extends super_array
{

    public function __construct()
    {
        self::$name_array = $_GET;
    }

    public static function last(): string
    {
        return trim($_SERVER['REQUEST_URI'],'/');
    }

    public static function full(): string
    {
        return $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI'] ;
    }

    public static function domen(): string
    {
        return $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['SERVER_NAME'].'/';
    }

}