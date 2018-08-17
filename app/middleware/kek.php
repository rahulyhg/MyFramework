<?php
/**
 * Created by PhpStorm.
 * User: egor
 * Date: 17.08.18
 * Time: 16:03
 */

namespace app\middleware;



use Components\middleware\middlewareInterface;

class kek implements middlewareInterface
{

    public function run()
    {
        echo 'kek';
    }
}