<?php


namespace Components\extension;


class location
{

    public static function back(): void
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

}