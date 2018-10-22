<?php

namespace app\controllers\site\basket;

use Components\Controller;

class basketController extends Controller
{

    public function show()
    {
       $helpersFunc = new miniBasketController();

       dump($helpersFunc->getCart());

        echo self::$twig->render('site/pages/basket/basket.html.twig',[
            'basket' => $helpersFunc->getCart()
        ]);
    }
}