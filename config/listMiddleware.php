<?php

class listMiddleware{

    private $list;

    function __construct(){
        $this->list = [

        ];
    }

    public function returnList(){
        return $this->list;
    }

    public function requireMiddleware(){
            foreach ($this->list as $key) {
                $object = new $key;
                $object->run();
            }

    }


}