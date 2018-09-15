<?php
/**
 * @param string $array
 */
if (!function_exists('dump')) {
    function dump($array = '')
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
}


/**
 * @param string $var
 */
if (!function_exists('dd')) {
    function dd($var = '')
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
        die;
    }
}



if(!function_exists('config')){
    function config(string $name): array
    {
        if(file_exists("config/".$name.'.php')){
            return require "config/".$name.".php";
        }
        \Components\extension\infoPages\error_page::showPageError("Not find config file: config/{$name}.php");
    }
}