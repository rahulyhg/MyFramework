<?php

use  Components\extension\arr\super_array;


function dump($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function dd($var)
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    die;
}


function en(array $arr): string
{
    return $arr[count($arr) - 1];
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

