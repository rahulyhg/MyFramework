<?php

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

    private $arguments = [];

    public function __construct()
    {
        try {
            $this->routes = Route::returnArrayRoutes();
        } Catch (Error $e) {
            error_page::showPageError("Routs are not created",$e);
        }

        $this->url = trim($_SERVER['REQUEST_URI'], '/');
    }

//Написате дестракт і знищити все крім обєкта

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

        $this->getNameAction();

        $this->getArgumentActionName();

        $this->getArguments();

        $this->getController();

        $this->requireClass();

        $this->middleware();

        call_user_func_array(array($this->object, $this->action), $this->arguments);
    }

    private function middleware():void
    {
        $middleware = new Middleware($this->key);
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
            die('Controller not found!');
        }

    }

    private function findClass($path): bool
    {

        if (file_exists($path . $this->path."/".$this->controller.".php")) {

            require_once  $path . $this->path."/".$this->controller.".php";

            $this->object = new $this->controller;

            return true;
        }

        return false;
    }
}