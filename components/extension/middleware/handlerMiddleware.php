<?php

namespace Components\extension\middleware;

use Components\core\treits\globalFunction;

class handlerMiddleware
{
    use globalFunction;

    private $list;

    protected $key;

    public function __construct($key)
    {
        $this->list = config('listMiddleware');
        $this->key = $key;
    }

    public function runGlobal(): void
    {
        if (isset($this->list[$this->key])) {
            $this->createMiddlewareObject($this->list[$this->key]);
        }

        foreach ($this->list as $key => $value) {
            if ($value == 'global') {
                $this->createMiddlewareObject($key);
            }
        }

    }

    private function createMiddlewareObject(string $name): void
    {
        $middl = new $name();
        $middl->run();
    }

    public function runGroupMiddleware(array $middlewares): void
    {
        $names = config('name_middleware');

        foreach ($middlewares as $key => $name) {

            if (isset($names[$name])) {

                $this->createMiddlewareObject($names[$name]);

            }
        }
    }
}