<?php

namespace app\controllers\kek;

use app\models\test;
use Components\Controller;

class indexController extends Controller {

    public function index(){

       $kek = self::table('test')->select()->rightJoin('lol')->on('lol_fi','fi')->where(['people' => 'kek43one'])->get();
        dump($kek);
        $lol = self::sql("SELECT * FROM `test` where  `people` = ?")->param(['kek43one']);
        dump($lol);
    }

}



