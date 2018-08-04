<?php

namespace Components;

use Components\db\models;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Components\functions_twig_shablons;
use Components\core\treits\globalFunction;



class Controller
{
    use globalFunction;


    protected static $twig;


    public function __construct()
    {
        if (empty(self::$twig)) {
            $this->twig();
        }
    }

    protected function twig(): Twig_Environment
    {
        if (empty(self::$twig)) {

            $list_dir_views = require_once 'config/list_directory_views.php';

            self::$twig = new Twig_Environment(

                new Twig_Loader_Filesystem($list_dir_views),

                ['cache' => 'twig_cache/', 'auto_reload' => true, 'strict_variables' => true]
            );

            $this->addGlobalsToTwig();
        }


        return self::$twig;
    }

    private function addGlobalsToTwig(): void
    {
        self::$twig->addGlobal('func', new functions_twig_shablons());
    }



}
