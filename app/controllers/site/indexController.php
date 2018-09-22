<?php

namespace app\controllers\site;

use app\models\mailing;
use app\models\main;
use app\models\tovars;
use Components\Controller;
use Components\extension\arr\Request;
use Components\extension\http\location;


class indexController extends Controller {


    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */


    public function showMainPage()
    {
        echo self::$twig->render('site/pages/main/main.html.twig', [
            'tovars'            => tovars::getAllTovarsWithMailSettings(main::tovarOurProductsIdWithMainSettings()),
            'on_sale'           => tovars::getAllTovarsWithMailSettings(main::tovarOnSaleIdWithMainSettings()),
            'list_tovars_categ' => main::getAllMainSettings('products'),
            'manufactures'      => main::getAllMainSettings('manufactures'),
            'slider_bottom'     => main::getAllMainSettings('slider_bottom'),
            'aboutSite'         => main::getAllMainSettings('about_site'),
            'slider_top'        => main::getAllMainSettings('slider_top'),
            'tovar_latest'      => tovars::getLastTenTovars(),
        ]);
    }



    public function subscriptionMailing(Request $request)
    {
        mailing::saveEmail($request->all());

        location::back();
    }
}



