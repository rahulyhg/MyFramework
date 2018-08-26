<?php


namespace Components\extension\arr;


class Get extends super_array
{

    public function __construct()
    {
        self::$name_array = $_GET;
    }

    public static function last(): string
    {
        $url = explode('/',$_SERVER['REQUEST_URI']);
        return end($url);
    }

    public static function full(): string
    {
        return $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI'] ;
    }

    public static function domen(): string
    {
        return $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['SERVER_NAME'].'/';
    }

    public static function site(): string
    {
        return $_SERVER['SERVER_NAME'];
    }

}