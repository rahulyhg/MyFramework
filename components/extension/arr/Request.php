<?php


namespace Components\extension\arr;

/**
 * Class Request
 * @package Components\extension\arr
 */


class Request extends super_array
{

    public function __construct()
    {
        self::$name_array = $_POST;
    }


}