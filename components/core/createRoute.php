<?php

namespace Components\core;

abstract class createRoute
{

    protected static $arrRoutes;

    protected static $debug_data;

    protected static $typeRoute;

    protected static function createRoute(string $path, string $controller): void
    {
        self::$debug_data = debug_backtrace();

        if(self::$debug_data[3]['function'] == 'group'){
            self::facadeChangeRouteIntoGroup(self::whereChallengeFunctions(),$path,$controller);
        }else{
            self::$arrRoutes[$path] = str_replace('@', '/', self::addTypeRouteToController($controller));
        }
    }

    private static function addTypeRouteToController(string $controller): string
    {
        if(!preg_match("~".self::$typeRoute."~",$controller)){
            return  $controller . '|' . self::$typeRoute;
        }
        return $controller;
    }


    private static function whereChallengeFunctions(): array
    {
        $result = [];

        foreach (self::$debug_data as $key=>$arr){
            if(isset($arr['function']) && $arr['function'] == 'group'){
                $result[] = $arr['args'][0];
            }
        }
        return $result;
    }

    private static function facadeChangeRouteIntoGroup(array $data,string $url,string $controller){

      foreach ($data as $key=>$arr){

          if(isset($arr['url'])){
              $url = trim($arr['url'],'/') . '/' . $url;
          }

          if(isset($arr['prefix'])){
              $controller = $arr['prefix'] . $controller;
          }

          if(isset($arr['path'])){
              $controller = $arr['path'] .'.'. $controller;
          }
      }

        self::createRoute($url,self::addTypeRouteToController($controller));
    }

    protected static function includePageWithRoutes(){

        $list_file_route = require_once 'config/list_route_file.php';

        foreach ($list_file_route as $key){
            if(file_exists($key)){
                require_once $key;
            }
        }
    }

    abstract public static function get(string $path, string $controller): createRoute;

    abstract public static function post(string $path, string $controller): createRoute;

    abstract public static function any(string $path, string $controller): createRoute;

    abstract public static function returnArrayRoutes(): array;


}