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

    public function last()
    {
        return trim($_SERVER['REQUEST_URI'],'/');
    }

    public function full()
    {
        return $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI'] ;
    }

}