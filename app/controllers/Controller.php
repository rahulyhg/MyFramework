<?php

class Controller{

//use globalFunction;

    public function view($url,array $variable = null){
        $url = str_replace('.','/',$url);
        if($variable !== null) {
            extract($variable, EXTR_PREFIX_SAME, "wddx");
        }
        require_once "views/$url.php";
        return $this;
    }

}
