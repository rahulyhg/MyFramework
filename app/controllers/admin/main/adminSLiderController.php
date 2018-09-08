<?php

namespace app\controllers\admin\main;


use Components\Controller;
use app\models\tovars;
use app\models\main;
use Components\extension\arr\Get;
use Components\extension\arr\Request;
use Components\extension\location;
use Components\extension\validate;


class adminSLiderController extends Controller
{


    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

    public function sliderPage()
    {
        echo self::$twig->render('admin/pages/main/sliders.html.twig', [
            'slider_bottom' => main::getAllMainSettings('slider_bottom')
        ]);
    }

    public function saveSettignsSlider(Request $request)
    {
        $error = $request->all()['slider'] == 'slider_top' ? main::updateTopSlider($request->all()) : main::saveSlider($request->all());

        validate::setAlert($error['message'],$error['type']);

        location::back();
    }


    public function deleteSettignsSlider(Get $get)
    {
        main::deleteSliderElement($get->last());
        location::back();
    }

}