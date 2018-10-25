<?php

namespace app\controllers\site\basket;

use app\models\tovars;
use Components\Controller;

class basketController extends Controller
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * SHIPPING З НАСТРОЙОК
     */
    public function show()
    {
       $helpersFunc = new miniBasketController();

        echo self::$twig->render('site/pages/basket/basket.html.twig',[
            'basket'        => $helpersFunc->getCart(),
            'randomsTovar'  => tovars::randomTovars(),
            'shipping'      => 40
        ]);
    }
}

//Зробити  js quality
// калькуляцію
// видаллення товару