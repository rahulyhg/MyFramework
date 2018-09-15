<?php

namespace Components\core;

use Components\Controller;
use Components\extension\infoPages\{error_page,page_404};
use Components\extension\middleware\handlerMiddleware;
use Components\extension\localization\siteLang;
use Components\core\routes\Route;

class core
{
    private $routes;

    public static $url;

    //Обєкт класа контроллера
    private $class;

    // Ключ до потрібного роутера в масиві роутерів
    private $key;

    private $route;

    //аргументи до метода контроллера
    private $arguments = [];

    //масив з назвами роутів
    public static $names;


    public function __construct()
    {
        new Controller();

        $this->routes = Route::returnArrayRoutes();

        $this->getUrl();

        $this->getArrNames();
    }

    private function getUrl(): void
    {
        $url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

        $url = preg_replace("~".implode('|',siteLang::$langsInSite)."~",'',$url);

        if($url !== '/'){
            $url = trim($url,'/');
        }

        self::$url = $url;
    }



    public function run(): void
    {
        $this->array_exits_patern() ? $this->facadeGetRout() : page_404::getInstance()->run();
    }


    private function array_exits_patern(): bool
    {
        foreach ($this->routes as $key => $value) {
            if ((empty(self::$url) && array_key_exists('/',$this->routes)) || preg_match('~^(' . $key . ')$~i',self::$url)) {
                $this->key = $key;
                return true;
            }
        }
        return false;
    }

    private  function getArrNames()
    {
        foreach($this->routes as $key=>$value){
            if(!empty($value['name'])){
                self::$names[$value['name']] = $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['SERVER_NAME'] .'/'. preg_replace('/\|get|\|post/','',$key);
            }
        }
    }



    private function facadeGetRout(): void
    {
        $this->changeRouteRequestMethod();

        $this->writeCheckedRoute();

        $this->requireClass();

        $this->middleware();

        $this->getArguments();

        $this->createObjectController();
    }


    private function changeRouteRequestMethod(): void
    {
        if (!preg_match('/\|get|\|post/', $this->key, $type)) {

            error_page::showPageError('Type route not find code: #157854', 'Type will be get/post');

        }

        $this->key = preg_replace('/\|get|\|post/','|'.mb_strtolower($_SERVER['REQUEST_METHOD']),$this->key);

    }

    private function writeCheckedRoute(): void
    {
        $this->route = $this->routes[$this->key] ??  error_page::showPageError($this->key ." not find route",'str 116 core.php, code #12345');
    }

    private function getArguments(): void
    {
        $reflection = new \ReflectionMethod($this->class, $this->route['action']);

        $param = $reflection->getParameters();

        foreach ($param as $key => $value) {

            $namespace = $value->getType()->getName();

            $this->arguments[] = new $namespace();

        }
    }

    private function requireClass(): void
    {
        if(!$this->findClass('app/controllers/') && !$this->findClass('components/Admin/controllers/')){

            error_page::showPageError("code: #nghfire23 Controller not find",'app/controllers/'.$this->route['path'] . '<br>' . 'components/Admin/controllers/'.$this->route['path']);

        }
    }

    private function middleware(): void
    {
        $middleware = new handlerMiddleware($this->key);

        $middleware->runGlobal();

        if (!empty($this->route['middleware']) && is_array($this->route['middleware'])) {

            $middleware->runGroupMiddleware($this->route['middleware']);
        }
    }


    private function createObjectController(): void
    {
        call_user_func_array(array($this->class, $this->route['action']), $this->arguments);
    }


    private function findClass(string $path): bool
    {
        if (file_exists($path . $this->route['path']."/". $this->route['controller'].".php")) {

            $this->class = $this->generateNamespace($path) . $this->route['controller'];

            return true;
        }

        return false;
    }


    private function generateNamespace(string $path): string
    {

        $namespace ='\\'.str_replace('/','\\',$path);

        if(!empty($this->route['path'])){
            $namespace .= str_replace('/','\\',$this->route['path']) . '\\';
        }

        return $namespace;
    }
}