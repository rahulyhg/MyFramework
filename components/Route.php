<?php
class Route
{

    public static $arr = [];

    public static $arrGroup =[];

    public static function group(array $seting,callable $controller){

        $controller();

        if(array_key_exists('path',$seting)){
            self::addPathGroup($seting['path']);
        }
        elseif(array_key_exists('cntrl',$seting)){
            self::addControllerGroup($seting['cntrl']);
        }
        elseif(array_key_exists('dr',$seting)){
            self::addDirectoryGroup($seting['dr']);
        }
        self::saveArrGroup();
    }

    public static function rt(string $path, string $controller){
        self::$arr[$path] = $controller;
    }

    public static function returnRoute(): array {
        self::replaceSymbol();
        dump(self::$arrGroup);
        return self::$arrGroup;
    }

    private static function addPathGroup(string $path){
        foreach (self::$arr as $key=>$value){
            unset(self::$arr[$key]);
            self::$arr[$path . '/' .$key] = $value;
        }
    }

    private static function addDirectoryGroup(string $directory){
        foreach (self::$arr as $key=>$value){
            self::$arr[$key] = $directory .'.'. $value;
        }
    }

    private static function replaceSymbol(){
        foreach (self::$arr as $key => $value){
            self::$arr[$key] = str_replace('@','/',$value);
        }
    }

    private static function addControllerGroup(string $name){
        foreach (self::$arr as $key=>$value){
            self::$arr[$key] = $name .'Controller@'. $value;
        }
    }

    private static function saveArrGroup(){
        foreach (self::$arr as $key=>$value){
            self::$arrGroup[$key] = $value;
        }
        self::$arr = [];
    }
}