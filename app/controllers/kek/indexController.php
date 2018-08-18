<?php

namespace app\controllers\kek;

use app\models\test;
use Components\Controller;
use Components\extension\arr\Request;
use Components\db\models;
use Components\extension\arr\super_array;
use Components\extension\arr\Get;


class indexController extends Controller {

    public function index(Get $get)
    {
        echo $get->full();
    }


}



