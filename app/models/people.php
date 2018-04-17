<?php


class people extends models
{

    public static function allPeople($request){
        self::update($request)->get();
    }
}