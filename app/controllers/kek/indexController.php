<?php

namespace app\controllers\kek;

use app\models\test;
use Components\Controller;

class indexController extends Controller {

    public function index(){

       $kek = self::table('test');

    }

}



