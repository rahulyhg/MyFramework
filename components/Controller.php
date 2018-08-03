<?php

class Controller
{
    use globalFunction;


    protected static $twig;



    protected function twig()
    {
        if(empty(self::$twig)){
            self::$twig = new Twig_Environment(new Twig_Loader_Filesystem('views/'),
            ['cache' => 'twig_cache/']
            );
        }

        return self::$twig;
    }


}
