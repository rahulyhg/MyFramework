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


function session(...$arr): super_array
{
    $object = new super_array($_SESSION);
    return $object->getArray(...$arr);
}

function get(...$arr): super_array
{
    $object = new super_array($_GET);
    return $object->getArray(...$arr);
}