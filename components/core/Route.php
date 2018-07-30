<?php

class Route
{

    private static $arrRoutes;

    private static $debug_data;


    public static function rt(string $path, string $controller): void
    {
        self::$debug_data = debug_backtrace();

        if(self::$debug_data[2]['function'] == 'group'){
            self::facadeChangeRouteIntoGroup(self::whereChallengeFunctions(),$path,$controller);
        }else{
            self::$arrRoutes[$path] = str_replace('@', '/', $controller);
        }
    }

    public static function group(array $data,callable $function): void
    {
        $function();
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
              $url = $arr['url'] . '/' . $url;
          }

          if(isset($arr['prefix'])){
              $controller = $arr['prefix'] . $controller;
          }

          if(isset($arr['path'])){
              $controller = $arr['path'] .'.'. $controller;
          }
      }

        self::rt($url,$controller);
    }


    public static function returnArrayRoutes(): array
    {
        self::includePageWithRoutes();

        return self::$arrRoutes;
    }

    private static function includePageWithRoutes(){

        $list_file_route = require_once 'config/list_route_file.php';

        foreach ($list_file_route as $key){
            if(file_exists($key)){
                require_once $key;
            }
        }
    }
}