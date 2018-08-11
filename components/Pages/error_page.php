<?php

namespace Components\Pages;

use Components\Controller;
use Components\core\treits\globalFunction;

class error_page extends Controller
{

    private const telephone = '0631479264';

    use globalFunction;

    public static function showPageError(string $message,$e = ''): void
    {
       self::addToLog($message,$e);
       echo self::$twig->render('page_error.html',['message' => $message,'e' => $e]);
       die;
    }

    public static function addToLog(string $message,$e = ''): void
    {
        $e = self::getMessageIfObject($e);

        $fp = fopen('log/'.date('y-m-d') .'.txt', "a");

        $message = date('h:i:s ') . ' ' .$message . ' ' . $e ."\n";

        fwrite($fp, $message);

        self::sendToTelegram($message);

        fclose($fp);
    }

    private static function getMessageIfObject($e): string
    {
       return is_object($e) ? $e->getMessage(). ' ' . $e->getFile() .' line:'. $e->getLine() : $e;
    }

    private static function sendToTelegram(string $message): void
    {

    }


}