<?php


namespace Components\twig;


trait twig_funct
{
    public static function search_str(string $patern,string $str)
    {
        return preg_match("~{$patern}~",$str);
    }

    public static function isset($var): bool
    {
        return isset($var);
    }
}