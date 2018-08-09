<?php

namespace app\controllers;

use app\models\test;
use Components\Controller;


class indexController extends Controller {

    public function index(){
        dump(session()->all());

        session()->add('key',['lol'=>['kek'=>1]]);

        dump(session('key.lol'));

    }

}



