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
        foreach ($this->list as $key => $value) {
            if ($this->key == $value || $value == 'global') {
                $object = new $key;
                if (method_exists($object, 'run')) {
                    $object->run();
                }
            }
        }
    }

}