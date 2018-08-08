<?php

use Components\core\super_array;


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


function session(string $arr = '')
{
    return super_array::createMethodForArrays($_SESSION,$arr);
}

function get(string $arr = '')
{
    return super_array::createMethodForArrays($_GET,$arr);
}

function server(string $arr = '')
{
    return super_array::createMethodForArrays($_SERVER,$arr);
}

function post(string $arr = '')
{
    return super_array::createMethodForArrays($_POST,$arr);
}

function globals(string $arr = '')
{
    return super_array::createMethodForArrays($GLOBALS,$arr);
}

function files(string $arr = '')
{
    return super_array::createMethodForArrays($_FILES,$arr);
}