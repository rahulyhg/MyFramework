<?php

namespace app\controllers;

use app\models\test;
use Components\Controller;


class indexController extends Controller {

    public function index(){
        //session()->add('key',['lol'=>'kek','lolh'=>[23.32]]);

        session()->delete('key.lolh');
        dump(session()->all());

    }

}



