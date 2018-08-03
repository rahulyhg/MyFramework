<?php


class error_page
{
    use globalFunction;

    public static function showPageError(string $message,$e = '')
    {
      self::view('error_page',['message'=> $message,'e' => $e]);
       die;
    }


}