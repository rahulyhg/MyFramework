<?php

namespace Components;


use Components\core\treits\globalFunction;
use Components\twig\twig;



class Controller
{
    use globalFunction;


    protected static $twig;


    public function __construct()
    {
        if (empty(self::$twig)) {
            $twig = new twig();
            self::$twig = $twig->runTwig();
        }

    }

}
