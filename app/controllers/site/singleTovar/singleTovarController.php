<?php

namespace app\controllers\site\singleTovar;

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
//ЧОМУСЬ БАГ ЗА GET $get
    public function show()
    {
        $tovar = tovars::getTovar(4);

        echo self::$twig->render('site/pages/singleTovar/single.html.twig', [
            'tovar'         => $tovar,
            'gallery'       => gallery::getPhoto(4),
            'analogTovar'   => tovars::getRandomTovarsInCategory($tovar[0]['category'] ?? 1),
            'randomsTovar'  => tovars::randomTovars(),
        ]);
    }
}