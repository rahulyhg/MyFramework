<?php

use PHPUnit\Framework\TestCase;
require_once 'app/controllers/Controller.php';
require_once 'app/controllers/Auth/authController.php';

class indexTest extends TestCase{

    public function testHomeNotRegister(){
        $object = new authController();
        $result =$object->getLogin();
        $result->assertUrlIs('/login');
    }

}