<?php

namespace Components\Pages;

use Components\Controller;
use Components\core\treits\globalFunction;
use Components\extension\log;
use Components\twig\twig;

class error_page
{

    use globalFunction;

    public static function showPageError(string $message, $e = ''): void
    {
        echo $message,$e;
        log::addToLog($message, $e);
        die;
    }




}