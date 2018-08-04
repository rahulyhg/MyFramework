<?php

namespace Components\Pages;

use Components\Controller;
use Components\core\treits\globalFunction;

class error_page extends Controller
{
    use globalFunction;

    public static function showPageError(string $message,string $e = ''): void
    {
       echo self::$twig->render('page_error.html',['message' => $message,'e' => $e]);
       die;
    }


}