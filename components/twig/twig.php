<?php

namespace Components\twig;


use Twig_Environment;
use Twig_Loader_Filesystem;


class twig
{

    public static $twig;


    public function runTwig(): Twig_Environment
    {
        $this->createTwigObject();

        $this->addGlobalsToTwig();

        return self::$twig;
    }

    private function createTwigObject(): void
    {
            $list_dir_views = require_once 'config/list_directory_views.php';

            self::$twig = new Twig_Environment(

                new Twig_Loader_Filesystem($list_dir_views),

                ['cache' => 'twig_cache/', 'auto_reload' => true, 'strict_variables' => true]
            );
    }

    private function addGlobalsToTwig(): void
    {
        self::$twig->addGlobal('func', new functions_twig_shablons());
    }



}