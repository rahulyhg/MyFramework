<?php

use  Components\extension\arr\super_array;


/**
 * @param array $arr
 * @return string
 */
if (!function_exists('dump')) {
    function arr_end(array $arr): string
    {
        return $arr[count($arr) - 1];
    }
}


if (!function_exists('lang')) {

    function lang()
    {
        return $_SESSION['lang']['id'];
    }
}
if (!function_exists('lang_domen')) {

function lang_domen()
{
    return $_SESSION['lang']['domen'];
}
}

if (!function_exists('session')) {

    function session(string $keys = '')
    {
        return super_array::createArr($keys, $_SESSION);
    }
}
if (!function_exists('get')) {
    function get(string $keys = '')
    {
        return super_array::createArr($keys, $_GET);
    }
}
if (!function_exists('server')) {

    function server(string $keys = '')
    {
        return super_array::createArr($keys, $_SERVER);
    }
}
if (!function_exists('post')) {

    function post(string $keys = '')
    {
        return super_array::createArr($keys, $_POST);
    }
}
if (!function_exists('globals')) {

    function globals(string $keys = '')
    {
        return super_array::createArr($keys, $GLOBALS);
    }
}
if (!function_exists('files')) {
    function files(string $keys = '')
    {
        return super_array::createArr($keys, $_FILES);
    }
}
