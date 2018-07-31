<?php

trait globalFunction{



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

    protected static function view(string $url, array $variable = null)
    {

        $url = str_replace('.', '/', $url);

        if ($variable !== null) {
            extract($variable, EXTR_PREFIX_SAME, "wddx");
        }
        try {
            require_once self::listDirectoryViews($url);
        } Catch (Error $e) {
            error_page::showPageError('Not such page views: '.$url,$e);
        }
    }

    private  static function listDirectoryViews(string $url): string
    {
        $list = require_once 'config/list_directory_views.php';

        foreach ($list as $key){
            if(file_exists($key . '/' . $url. '.php')){
                return $key . '/' . $url .'.php';
            }
        }
    }

}