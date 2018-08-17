<?php

namespace Components;


use Components\core\treits\globalFunction;
use Components\twig\twig;



class Controller
{
    use globalFunction;


    protected static $redis;

    protected static $twig;


    public function __construct()
    {
        if (empty(self::$twig)) {
            $twig = new twig();
            self::$twig = $twig->runTwig();
        }

    }



    public function redisConnect(): \Predis\Client
    {
        if (empty(self::$redis)) {
           // echo `redis-server`;
            self::$redis = new \Predis\Client(['scheme' => 'tcp', 'host' => '127.0.0.1', 'port' => 6379]);
        }
        return self::$redis;
    }


}
