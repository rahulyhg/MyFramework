<?php


class people extends models
{
    public static function allPeople(){
     return self::select(['people'])->show();
    }

}