<?php

namespace app\controllers;

use app\models\main;
use app\models\tovars;
use Components\Controller;
use Components\db\database;
use Components\db\models;


class indexController extends Controller {


    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

    public function showMainPage()
    {
        echo self::$twig->render('pages/main/main.html.twig', [
            'tovars'            => tovars::getAllTovarsWithMailSettings(main::tovarOurProductsIdWithMainSettings()),
            'list_tovars_categ' => main::getAllMainSettings()['products']['data'],
            'tovar_latest'      => tovars::getLastTenTovars(),
            'on_sale'           => tovars::getAllTovarsWithMailSettings(main::tovarOnSaleIdWithMainSettings())
        ]);
    }


}



