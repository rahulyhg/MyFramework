<?php

use  Components\extension\arr\super_array;

/**
 * @param string $array
 */

function dump($array=  '')
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


/**
 * @param string $var
 */

function dd($var = '')
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    die;
}

/**
 * @param array $arr
 * @return string
 */
function en(array $arr): string
{
    return $arr[count($arr) - 1];
}



function lang()
{
    return $_SESSION['lang']['id'];
}



function session(string $keys = '')
{
    return super_array::createArr($keys, $_SESSION);
}

function get(string $keys = '')
{
    return super_array::createArr($keys, $_GET);
}

function server(string $keys = '')
{
    return super_array::createArr($keys, $_SERVER);
}

function post(string $keys = '')
{
    return super_array::createArr($keys, $_POST);
}

function globals(string $keys = '')
{
    return super_array::createArr($keys, $GLOBALS);
}

function files(string $keys = '')
{
    return super_array::createArr($keys, $_FILES);
}

