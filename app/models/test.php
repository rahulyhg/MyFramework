<?php

namespace app\models;

use Components\db\models;

class test extends models
{

    public static function allPeople(){
        return self::select('id')->where('people','ewf')->get();
    }
    public static function kek(){
        return self::where('people','ewf')->get();
    }
}