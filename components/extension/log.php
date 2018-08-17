<?php
/**
 * Created by PhpStorm.
 * User: egor
 * Date: 16.08.18
 * Time: 18:12
 */

namespace components\extension;

use Components\extension\telegarm;

class log
{
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
        new telegarm();

    }
}