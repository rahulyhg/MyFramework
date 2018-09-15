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



