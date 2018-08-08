<?php

namespace Components\core;

use Components\core\treits\globalFunction;

class super_array
{
    use globalFunction;


    private  $super_array;


    public function __construct(array $array)
    {
        $this->super_array = $array;
    }



    public  function getArray(...$arr)
    {
        return !empty($arr) ? self::searchKey(array_values($arr)) : $this;
    }

    public function add($key,$value): void
    {
        $this->super_array[$key] = $value;
    }

    public function all():array
    {
        return $this->super_array;
    }

}