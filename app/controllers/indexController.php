<?php

namespace app\controllers;

use app\models\test;
use Components\Controller;
use Components\extension\arr\Request;
use Components\db\models;
use Components\extension\arr\super_array;
use Components\extension\arr\Get;
use app\models\lol;
use Components\extension\pagination;

class indexController extends Controller {

    public function showMainPage()
    {
      echo self::$twig->render('pages/main/main.html.twig',['arr'=> '']);
    }


}



