<?php

class user extends models{

    public static function saveUser($post,$files=null){
        $post['img'] = $_FILES['img']['name'];
        self::saveImg();
       self::saveAll($post);
    }

    public static function whereLogin($login){
       $array =  self::suchWhere('user',$login,['password']);
    foreach ($array as $key => $value){
        return $value['password'];
    }
    }

    public static function returnUserProfile($login){
       $list = self::suchWhere('user',$login);
    return $list[0];

    }

}