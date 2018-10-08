<?php

namespace app\controllers\admin\cat;

use Components\Controller;

class adminCatController extends Controller
{
    public function index()
    {
        echo self::$twig->render('admin/pages/cat/index.html.twig',[]);
    }

}