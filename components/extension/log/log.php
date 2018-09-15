<?php


namespace Components\extension\log;

use Components\extension\messengers\telegram\telegarm;

class log
{

    public static function addToLog(string $message,$e = ''): void
    {
        $e = self::getMessageIfObject($e);

        $fp = fopen('log/'.date('y-m-d') .'.txt', "a");

        $message = date('h:i:s ') . ' ' .$message . ' ' . $e ."\n";

        fwrite($fp, $message);

        fclose($fp);

        self::sendToTelegram($message);
    }

    /**
     * @param $e
     * @return string
     */

    private static function getMessageIfObject($e): string
    {
        return is_object($e) ? $e->getMessage(). ' ' . $e->getFile() .' line:'. $e->getLine() : $e;
    }

    private static function sendToTelegram(string $message): void
    {
        new telegarm();

    }
}