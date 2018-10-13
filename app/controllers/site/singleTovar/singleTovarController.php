<?php

namespace  app\controllers\site\singleTovar;

use Components\Controller;
use Components\extension\arr\Get;

class singleTovarController extends Controller
{

    public function show(Get $get)
    {
        echo $get->last();
        echo self::$twig->render('site/pages/singleTovar/single.html.twig',[]);
    }
}