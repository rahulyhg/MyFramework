<?php


namespace Components\extension\helpers;


class location
{

    public static function back(): void
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

}