<?php

namespace Components\middleware;

use Components\core\treits\globalFunction;

class handlerMiddleware
{
    use globalFunction;

    private $list;

    private $key;

    public function __construct($key)
    {
        $this->list = require_once 'config/listMiddleware.php';
        $this->key = $key;
    }

    public function run(): void
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

}