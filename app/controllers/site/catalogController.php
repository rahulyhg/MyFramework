<?php

namespace app\controllers\site;

use app\models\tovars;
use Components\Controller;
use app\models\main;

class catalogController extends Controller
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

    public function show()
    {
        echo self::$twig->render('site/pages/cat/index.html.twig',[
            'tovars'    => tovars::getAllTovars(),
            'featured'  => $this->featured(),
        ]);
    }

    private function featured($features_tovar = [])
    {
        $id = main::getAllMainSettings('products')['featured'];
        $tovars = tovars::getAllTovarsWithMailSettings(main::tovarOurProductsIdWithMainSettings());

        foreach ($tovars as $key=>$value){
            if(preg_match("~{$value['lid']}~",$id)){
                $features_tovar[] = $value;
            }
        }
        return $features_tovar;
    }

}