<?php


class test extends models
{

    public static function allPeople(){
        return self::where('people','ewf')->get();
    }
}