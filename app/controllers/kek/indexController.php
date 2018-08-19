<?php

namespace app\controllers\kek;

use app\models\test;
use Components\Controller;
use Components\extension\arr\Request;
use Components\db\models;
use Components\extension\arr\super_array;
use Components\extension\arr\Get;
use app\models\lol;
use Components\extension\pagination;

class indexController extends Controller {

    public function index(Get $get)
    {
      $arr = lol::selectAll();
      echo self::$twig->render('index.html',['arr'=> $arr]);
    }


}



