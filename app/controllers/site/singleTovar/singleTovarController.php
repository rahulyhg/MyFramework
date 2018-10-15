<?php

namespace  app\controllers\site\singleTovar;

use app\models\gallery;
use app\models\tovars;
use Components\Controller;
use Components\extension\arr\Get;

class singleTovarController extends Controller
{
    /**
     * @param Get $get
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

    public function show(Get $get)
    {
        echo self::$twig->render('site/pages/singleTovar/single.html.twig',[
            'tovar' => tovars::getTovar($get->last())[0],
            'gallery' => gallery::getPhoto($get->last()),
        ]);
    }
}