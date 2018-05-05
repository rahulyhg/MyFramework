<?php

class listMiddleware{

    private $list;

    public function __construct(){
        $this->list = [
            'postMiddleware'
        ];
    }

    public function returnList(): array {
        return $this->list;
    }

    public function requireMiddleware(){
            foreach ($this->list as $key) {
                $object = new $key;
                $object->run();
            }

    }


}