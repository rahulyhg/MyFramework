<?php


class page_404 extends Controller
{
    use globalFunction;

    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance(): page_404{

        if(empty(self::$instance)){

            self::$instance = new self();

            return self::$instance;
        }

        return self::$instance;
    }

    public function run(){
        echo '404';
    }

}