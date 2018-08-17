<?php

namespace Components\core;

use Components\Controller;
use Components\core\route;
use Components\Pages\{error_page,page_404};
use Components\middleware\handlerMiddleware;
use Components\core\Request;

use ReflectionMethod;
class core
{
    private $routes;

    private $url;

    //Обєкт класа контроллера
    private $class;

    // Ключ до потрібного роутера в масиві роутерів
    private $key;

    private $route;

    //аргументи до метода контроллера
    private $arguments = [];



    public function __construct()
    {
        new Controller();

       // migrations::getMigration();

        try {

            $this->routes = route::returnArrayRoutes();

        } Catch (\Error $e) {

            error_page::showPageError("Routs are not created", $e);
        }

        $this->getUrl();
    }

    private function getUrl(): void
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $this->url = parse_url($url,PHP_URL_PATH);
    }



    public function run(): void
    {
        $this->array_exits_patern() ? $this->facadeGetRout() : page_404::getInstance()->run();
    }


    private function array_exits_patern(): bool
    {
        foreach ($this->routes as $key => $value) {
            if ((empty($this->url) && array_key_exists('/',$this->routes)) || preg_match('~(' . $key . ')$~i', $this->url)) {
                $this->key = $key;
                return true;
            }
        }
        return false;
    }



    private function facadeGetRout(): void
    {
        $this->changeRouteRequestMethod();

        $this->writeCheckedRoute();

        $this->requireClass();

        $this->middleware();

        $this->settingsRequestType();

        $this->getArguments();

        $this->createObjectController();
    }


    private function changeRouteRequestMethod(): void
    {
        if (!preg_match('/\|get|\|post|\|any/', $this->key, $type)) {

            error_page::showPageError('Type route not find', 'Type will be get/post');

        }

        $this->key = preg_replace('/\|get|\|post|\|any/','|'.mb_strtolower($_SERVER['REQUEST_METHOD']),$this->key);
    }

    private function writeCheckedRoute(): void
    {
        $this->route = $this->routes[$this->key] ??  error_page::showPageError($this->key ." not find route",'str 116 core.php, code #1');;
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

            error_page::showPageError("Controller not find",'app/controllers/'.$this->route['path'] . '<br>' . 'components/Admin/controllers/'.$this->route['path']);

        }
    }

    private function middleware(): void
    {
        $middleware = new handlerMiddleware($this->key);

        $middleware->run();
    }


    private function settingsRequestType(): void
    {
        switch ($_SERVER['REQUEST_METHOD']) {

            case 'POST':
                $this->postRequest();
                break;
            case 'GET':
                $this->GETrequest();
                break;
            default:
                error_page::showPageError('This type route not found, route will be get|post','code #00003');
        }

    }

    private function createObjectController()
    {
        try {
            call_user_func_array(array($this->class, $this->route['action']), $this->arguments);
        }Catch(\Error $e){
            error_page::showPageError('Not found arguments',$e->getMessage(). " LINE:  ". $e->getLine() .' -- code #54545');
        }
    }


    private function postRequest(): void
    {
       // $this->arguments[] = new Request;
    }

    private function GETrequest(): void
    {
     // муйбутні дії коли гет запит
    }

    private function findClass($path): bool
    {
        if (file_exists($path . $this->route['path']."/". $this->route['controller'].".php")) {

            $this->class = $this->generateNamespace($path) . $this->route['controller'];

            return true;
        }

        return false;
    }

    private function generateNamespace($path){

        $namespace ='\\'.str_replace('/','\\',$path);

        if(!empty($this->route['path'])){
            $namespace .= str_replace('/','\\',$this->route['path']) . '\\';
        }

        return $namespace;
    }
}