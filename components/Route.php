<?php
class Route
{

    public static $arr = [];

    public static $arrGroup =[];

    private static $rt = [];

    public static function group(array $seting,callable $controller){

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

    public static function rt(string $path, string $controller){
        self::$arr[$path] = $controller;
        if(!in_array('group',debug_backtrace()[2])){
            self::$rt[$path] = $controller;
            unset(self::$arr[$path]);
        }
    }

    public static function name($info,callable $funct){
        $funct();
    }

    public static function returnRoute(): array {
        require_once 'routes\web.php';
        self::replaceSymbol();
        return  self::$arrGroup ;
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

        foreach (array_merge(self::$arrGroup,self::$rt) as $key => $value){
            self::$arrGroup[$key] = str_replace('@','/',$value);
        }
    }

    private static function addControllerGroup(string $name){
        foreach (self::$arr as $key=>$value){
            self::$arr[$key] = $name .'Controller@'. $value;
        }
    }

    private static function saveArrGroup(){
        self::$arrGroup = array_merge(self::$arrGroup,self::$arr);
        self::$arr = [];
    }
}