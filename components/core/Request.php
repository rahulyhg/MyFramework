<?php


namespace Components\core;


class Request extends super_array
{

    public function __construct()
    {
        self::$name_array = $_POST;
    }


}