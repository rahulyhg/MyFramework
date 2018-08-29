<?php

namespace app\controllers\admin;


use Components\Controller;
use app\models\tovars;
use app\models\main;
use Components\extension\arr\Request;
use Components\extension\location;

class mainController extends Controller
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

    public function show()
    {
        $main_tovar = main::getAllMainSettings();

        echo self::$twig->render('admin/pages/main.html.twig',[
            'tovar'     => $main_tovar['products']['data'],
            'on_sale'   => $main_tovar['on_sale']['data']
        ]);
    }

    public function save(Request $request)
    {
       main::saveRequest($request->all());

       location::back();
    }

}