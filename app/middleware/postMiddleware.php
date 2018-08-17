<?php

namespace app\middleware;

use Components\middleware\middlewareInterface;

class postMiddleware implements middlewareInterface
{

    public function run()
    {
        echo 1;
    }
}