<?php

namespace app\controllers;

use app\models\main;
use app\models\tovars;
use Components\Controller;
use Components\db\database;
use Components\db\models;


class indexController extends Controller {




    public function showMainPage()
    {
        echo self::$twig->render('pages/main/main.html.twig', [
            'tovars'            => tovars::getAllTovarsWithMailSettings(),
            'list_tovars_categ' => main::getAllMainSettings()['products']
        ]);
    }


}



