<?php

class Route
{

    private static $arr = [];

    private static $arrGroup = [];

    private static $rt = [];


    public static function group(array $seting, callable $controller): void
    {

        $controller();

        if (array_key_exists('path', $seting)) {
            self::addPathGroup($seting['path']);
        }
        if (array_key_exists('cntrl', $seting)) {
            self::addControllerGroup($seting['cntrl']);
        }
        if (array_key_exists('dr', $seting)) {
            self::addDirectoryGroup($seting['dr']);
        }

        self::saveArrGroup();
    }

    public static function rt(string $path, string $controller): void
    {
        self::$arr[$path] = $controller;

        if (!in_array('group', debug_backtrace()[2])) {
            self::$rt[$path] = $controller;
            unset(self::$arr[$path]);
        }
    }

    public static function returnRoute(): array
    {
        $arr_directory = require_once "config/list_route_file.php";

        foreach ($arr_directory as $key){
            if(is_file($key)){
                require_once $key;
            }
        }

        self::replaceSymbol();

        return self::$arrGroup;
    }

    private static function addPathGroup(string $path): void
    {
        foreach (self::$arr as $key => $value) {
            unset(self::$arr[$key]);
            self::$arr[$path . '/' . $key] = $value;
        }
    }

    private static function addDirectoryGroup(string $directory): void
    {
        foreach (self::$arr as $key => $value) {
            self::$arr[$key] = $directory . '.' . $value;
        }
    }

    private static function replaceSymbol(): void
    {

        foreach (array_merge(self::$arrGroup, self::$rt) as $key => $value) {
            self::$arrGroup[$key] = str_replace('@', '/', $value);
        }
    }

    private static function addControllerGroup(string $name): void
    {
        foreach (self::$arr as $key => $value) {
            self::$arr[$key] = $name . $value;
        }
    }

    private static function saveArrGroup(): void
    {
        self::$arrGroup = array_merge(self::$arrGroup, self::$arr);
        self::$arr = [];
    }
}