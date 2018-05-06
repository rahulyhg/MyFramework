<?php

class core{

    private $routes;

    private $url;

    function __construct(){
        $this->routes = Route::returnRoute();
        dump($this->routes);
        $this->url = trim($_SERVER['REQUEST_URI'],'/');
    }

    public function run()    {
        foreach ($this->routes as $key => $value) {
            if (preg_match("~$key~",$this->url)) {
                $inner = preg_replace("~$key~", $value,$this->url);

                $masuv = explode('/', $inner);
                $controller = array_shift($masuv);
                $action = array_shift($masuv);

                $path = self::nameAction($controller,'.');
                $controller = self::nameController($controller,'.');

                self::fileTrue($controller, $path);

                $object = new $controller;
                $result = call_user_func_array(array($object, $action), $masuv);

                if ($result != null) {
                    break;
                }
            }
        }
    }

    private function fileTrue($controller,$path){
            return file_exists("app/controllers/$path/$controller.php") ? require_once "app/controllers/$path/$controller.php" : 'Controller not found ' ;
    }

    private static function nameController($masuv,$symbol){
        $arr = explode($symbol, $masuv);
        return $arr[1];
    }

    private static function nameAction($masuv, $symbol){
        $arr = explode($symbol, $masuv);
        return array_shift($arr);
    }

}