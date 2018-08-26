<?php

namespace app\controllers;

use app\models\main;
use app\models\tovars;
use Components\Controller;
use Components\extension\arr\Request;
use Components\db\models;
use Components\extension\arr\super_array;
use Components\extension\arr\Get;
use Components\extension\pagination;

class indexController extends Controller {

    public function showMainPage()
    {
        echo self::$twig->render('pages/main/main.html.twig', [
            'tovars'            => tovars::getAllTovarsWithMailSettings(),
            'list_tovars_categ' => main::getAllMainSettings()['products']
        ]);
    }


}



