<?php

trait globalFunction{

    public function view($url,array $variable = null){
        $url = str_replace('.','/',$url);
        if($variable !== null) {
            extract($variable, EXTR_PREFIX_SAME, "wddx");
        }
        require_once "views/$url.php";
    }

    public static function isUser($login){
        $_SESSION['user'] = $login;
        header('Location: /');
    }

    public static function exitUser(){
        $_SESSION = array();
    }

    public static function saveImg($upload_path='public/images/',$name = 'img'){
        $filename = $_FILES[$name]['name'];
        move_uploaded_file($_FILES[$name]['tmp_name'],$upload_path . $filename);
    }

    public static function nameClass(){
        $name = get_called_class();
        return $name == 'models' ? self::$name_table : $name;
    }

}