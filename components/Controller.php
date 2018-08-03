<?php

class Controller
{
    use globalFunction;


    protected static $twig;



    protected function twig()
    {
        if(empty(self::$twig)){

            $list_dir_views = require_once 'config/list_directory_views.php';

            self::$twig = new Twig_Environment(

            new Twig_Loader_Filesystem($list_dir_views),

            ['cache' => 'twig_cache/']
            );
        }

        return self::$twig;
    }


}
