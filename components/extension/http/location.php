<?php


namespace Components\extension\http;


class location
{

    public static function back(): void
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    public static function href(string $url)
    {
        header("Location: $url");
    }

}