<?php

namespace Components\extension\infoPages;

use Components\extension\log\log;
use Components\core\treits\globalFunction;

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