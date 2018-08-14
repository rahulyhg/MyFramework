<?php

namespace Components\core;

use Components\Controller;
use Components\core\route;
use Components\Pages\{error_page,page_404};
use Components\middleware\handlerMiddleware;
use Components\core\Request;


class core
{
    private $routes;

    private $url;

    private $action;

    private $controller;

    //Обєкт класа контроллера
    private $object;

    //шлях до контроллера
    private $path;

    // індекси масиву аргументів для функції контроллера
    private $argumentsName;

    // Ключ до потрібного роутера в масиві роутерів
    private $key;


    private $typeRoute;

    //аргументи до метода
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

    private function getTypeRoute(): void
    {
        if(!preg_match('/\|get|\|post|\|any/',$this->routes[$this->key],$type)) {

            error_page::showPageError('Type route not find','Type will be get/post');

        }
            $this->typeRoute = str_replace('|', '', $type[0]);

            $this->routes[$this->key] = preg_replace('/\|get|\|post|\|any/', '', $this->routes[$this->key]);
    }


    private function getUrl(): void
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $this->url = parse_url($url,PHP_URL_PATH);
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


    public function run(): void
    {
        $this->array_exits_patern() ? $this->facadeGetRout() : page_404::getInstance()->run();
    }

    private function facadeGetRout(): void
    {
        $this->getTypeRoute();

        $this->getNameAction();

        $this->getArgumentActionName();

        $this->getArguments();

        $this->getController();

        $this->requireClass();

        $this->middleware();

        $this->createObjectController();
    }

    private function createObjectController()
    {
        switch ($this->typeRoute) {
            case 'post' || 'any':
                $this->createPostControllerObject();
                break;
            case 'get':
                call_user_func_array(array($this->object, $this->action), $this->arguments);
                break;
            default:
                error_page::showPageError('This type route not found? get|post');
        }

    }


    private function createPostControllerObject()
    {
            $this->arguments[] = new Request;
            return call_user_func_array(array($this->object, $this->action), $this->arguments);
    }

    private function middleware():void
    {
        $middleware = new handlerMiddleware($this->key);
        $middleware->run();
    }

    private function getNameAction(): void
    {
        $actionAndArguments = explode('/', trim(stristr($this->routes[$this->key], '/'), '/'));
        $this->action = array_shift($actionAndArguments);
    }


    private function getArgumentActionName(): void
    {
        $actionAndArguments = trim(stristr($this->routes[$this->key], '/'), '/');
        $this->argumentsName = trim(str_replace($this->action, '', $actionAndArguments), '/');
    }


    private function getArguments(): void
    {
        if (!empty($this->argumentsName)) {
            $arrArguments = explode('/', str_replace('$', '', $this->argumentsName));

            $arrUrl = explode('/', $this->url);

            foreach ($arrArguments as $key) {
                array_push($this->arguments, $arrUrl[$key - 1]);
            }
        }
    }


    private function getController(): void
    {

        $patern = '/' . $this->action;

        if (!empty($this->argumentsName)) {
            $patern .= '/' . $this->argumentsName;
        }

        $puthAndController = explode('.', str_replace($patern, '', $this->routes[$this->key]));

        $this->controller = array_pop($puthAndController);

        $this->path = implode('.', $puthAndController);
    }



    private function requireClass(): void
    {
        if(!$this->findClass('app/controllers/') && !$this->findClass('components/Admin/controllers/')){

            error_page::showPageError("Controller not find",'app/controllers/'.$this->path . '<br>' . 'components/Admin/controllers/'.$this->path);

        }
    }

    private function findClass($path): bool
    {

        if (file_exists($path . $this->path."/".$this->controller.".php")) {

            $controller = $this->generateNamespace($path) .$this->controller;

            $this->object = new $controller();

            return true;
        }

        return false;
    }

    private function generateNamespace($path){

        $namespace ='\\'.str_replace('/','\\',$path);

        if(!empty($this->path)){
            $namespace .= str_replace('/','\\',$this->path) . '\\';
        }
        return $namespace;
    }
}