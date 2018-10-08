<?php

namespace app\controllers\admin;

use Components\Controller;

class adminIndexController extends Controller
{
    public function show()
    {
        echo self::$twig->render('admin/index.html.twig');
    }

    public function lol()
    {
        echo self::$twig->render('admin/pages/main.html.twig');
    }

}