<?php

use PHPUnit\Framework\TestCase;
require_once 'app/controllers/Controller.php';

class indexTest extends TestCase{

    public function testHomeNotRegister(){
        $object = new Controller();
        $object->view('category.index',['hello'=>'hello 3world','kok'=>'rt']);
        $this->assertFileIsReadable('views/category/index.php');
    }

}