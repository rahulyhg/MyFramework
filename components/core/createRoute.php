<?php

namespace Components\core;

abstract class createRoute
{

    protected static $arrRoutes;

    protected static $debug_data;

    protected static $typeRoute;

    protected static $name;

    private static $middleware = [];

    protected static function createRoute(string $path, string $controller): void
    {
        self::$debug_data = debug_backtrace();

        if(self::$debug_data[3]['function'] == 'group'){
            self::facadeChangeRouteIntoGroup(self::whereChallengeFunctions(),$path,$controller);
        }else{
            self::createArrayInformationAboutRoute($path,$controller);
            self::$middleware = [];
        }
    }

    private static function createArrayInformationAboutRoute(string $path, string $controller): void
    {
        $classController = explode('@', $controller);

        $controller = explode('.',$classController[0]);

        $action = explode('/', $classController[1]);

        self::$arrRoutes[$path . '|' . self::$typeRoute] =
            [
                'controller'    => array_pop($controller),
                'action'        => array_shift($action),
                'path'          => implode('/',$controller),
                'name'          => self::$name,
                'middleware'    => self::$middleware
            ];

        self::$name = '';
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

    private static function facadeChangeRouteIntoGroup(array $data,string $url,string $controller): void
    {

      foreach ($data as $key=>$arr){

          if(isset($arr['url'])){
              $url = trim($arr['url'],'/') . '/' . $url;
          }

          if(isset($arr['path'])){
              $controller = $arr['path'] .'.'. $controller;
          }

          if (isset($arr['as'])) {
              self::$name = empty(self::$name) ?  $arr['as'] : $arr['as'] . '.' . self::$name;
          }

          if (isset($arr['middleware'])) {
              self::$middleware[] =  $arr['middleware'];
          }

      }

        self::createRoute($url,$controller);
    }



    protected static function includePageWithRoutes(){

        $list_file_route = require_once 'config/list_route_file.php';

        foreach ($list_file_route as $key){
            if(file_exists($key)){
                require_once $key;
            }
        }
    }

    abstract public static function get(string $path, string $controller): Route;

    abstract public static function post(string $path, string $controller): Route;

    abstract public static function any(string $path, string $controller): Route;

    abstract public static function returnArrayRoutes(): array;


}