<?php

namespace Components\Pages;

use Components\Controller;
use Components\core\treits\globalFunction;
use Components\extension\log;

class error_page extends Controller
{

    use globalFunction;

    public static function showPageError(string $message,$e = ''): void
    {
       log::addToLog($message,$e);
       echo self::$twig->render('page_error.html',['message' => $message,'e' => $e]);
       die;
    }




}