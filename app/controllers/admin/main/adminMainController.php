<?php

namespace app\controllers\admin\main;


use Components\Controller;

use app\models\main;
use Components\extension\arr\Request;
use Components\extension\http\location;

class adminMainController extends Controller
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

    public function show()
    {
        $main_tovar = main::getAllMainSettings();

        echo self::$twig->render('admin/pages/main/main.html.twig',[
            'tovar'     => $main_tovar['products']['data'],
            'on_sale'   => $main_tovar['on_sale']['data']
        ]);
    }

    public function save(Request $request)
    {
       main::saveRequest($request->all());

       location::back();
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

    public function aboutSite()
    {
        $aboutSite = main::getAllMainSettings('about_site');

        echo self::$twig->render('admin/pages/main/aboutSite.html.twig',[
            'aboutSite'     => $aboutSite,
        ]);
    }

    public function saveAboutSite(Request $request)
    {
      main::saveAboutSite($request->all());
      location::back();
    }

}