<?php


namespace app\models;

use Components\db\models;

class lol extends models
{

    static function selectAll()
    {
        return self::select()->pagination(2,28)->get();
    }

}