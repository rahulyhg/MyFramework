<?php

namespace Components\core\treits;


use Components\db\models;
use Components\db\database;
use Components\extension\arr\Get;

trait globalFunction
{

    public static function saveImg($upload_path = 'public/images/', $name = 'img')
    {
        $filename = $_FILES[$name]['name'];
        move_uploaded_file($_FILES[$name]['tmp_name'], $upload_path . $filename);
    }

    protected static function table(string $table): models
    {
        $object = new models();
        $object::$name_table = $table;
        return $object;
    }

    public static function sql(string $sql): models
    {
        return models::sql($sql);
    }

    public static function  route(string $name): string
    {
        $arr =  \Components\core\core::$names;
        return $arr[$name] ?? \Components\Pages\error_page::showPageError(" not find name route {$name}",', code #361');
    }

    public static function assets(string $url,$admin = false): string
    {
        $url = trim($url,'/');
        return $admin ?  Get::domen().'components/Admin/public/'.$url : Get::domen().'public/'.$url;
    }
}
