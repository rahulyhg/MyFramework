<?php

namespace Components;


use Components\core\treits\globalFunction;
use Components\extension\twig\twig;

/**
 * Class Controller
 * @package Components
 */

class Controller
{
    use globalFunction;

    /**
     * @var \Twig_Environment
     */

    protected static $twig;

    /**
     * Controller constructor.
     */

    public function __construct()
    {
        if (empty(self::$twig)) {
            $twig = new twig();
            self::$twig = $twig->runTwig();
        }

    }

}
