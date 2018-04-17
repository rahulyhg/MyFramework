<?php

class listDerectoryAutoload
{
    private $list;

    function __construct(){
    $this->list = [

        'components',
        'config',
        'components/traits/db',
        'components/traits',
        'components/db',
        'app/controllers',
        'app/middleware',
        'app/models',
        'tests/',
        'components/middleware',
    ];
    }

    public  function listtDirectory()
    {
        return $this->list;
    }

}