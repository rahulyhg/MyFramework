<?php

namespace app\controllers\kek;

use app\models\test;
use Components\Controller;
use Components\core\Request;
use Components\db\models;
use Components\core\super_array;


class indexController extends Controller {

    public function index()
    {
   echo "<form action ='' method='post' ><input name='lol' value='12'> <input type='submit'></form>";
    }

    public function post(super_array $fop,Request $kek)
    {
       print_r($kek->all());
    }

}



