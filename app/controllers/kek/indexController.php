<?php

namespace app\controllers\kek;

use app\models\test;
use Components\Controller;
use Components\core\Request;
use Components\db\models;



class indexController extends Controller {

    public function index()
    {
   echo "<form action ='' method='post' ><input name='lol' value='12'> <input type='submit'></form>";
    }

    public function post(Request $request)
    {
       dump($request->all());
    }

}



