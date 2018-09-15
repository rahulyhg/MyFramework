<?php

namespace Components\extension\twig;

use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Class twig
 * @package Components\twig
 */

class twig
{

    /**
     * @var Twig_Environment $twig
     */


    public static $twig;


    /**
     * @return Twig_Environment
     */


    public function runTwig(): Twig_Environment
    {
        $this->createTwigObject();

        $this->addGlobalsToTwig();

        return self::$twig;
    }

    private function createTwigObject(): void
    {
            $list_dir_views = require 'config/list_directory_views.php';

            self::$twig = new Twig_Environment(

                new Twig_Loader_Filesystem($list_dir_views),

                ['cache' => false, 'auto_reload' => true, 'strict_variables' => true]
            );
    }


    private function addGlobalsToTwig(): void
    {
        self::$twig->addExtension(new twig_extension_func());
    }


}