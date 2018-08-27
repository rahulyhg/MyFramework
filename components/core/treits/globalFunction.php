<?php

namespace Components\core\treits;


use Components\db\models;
use Components\db\database;
use Components\extension\arr\Get;

trait globalFunction
{
    /**
     * @param string $upload_path
     * @param string $name
     */




    public static function saveImg($upload_path = 'public/images/', $name = 'img')
    {
        $filename = $_FILES[$name]['name'];
        move_uploaded_file($_FILES[$name]['tmp_name'], $upload_path . $filename);
    }



    /**
     * @param string $table
     * @return models
     */


    protected static function table(string $table): models
    {
        $object = new models();
        $object::$name_table = $table;
        return $object;
    }


    /**
     * @param string $sql
     * @return models
     */


    public static function sql(string $sql): models
    {
        return models::sql($sql);
    }



    /**
     * @param string $name
     * @return string
     */



    public static function  route(string $name): string
    {
        $arr =  \Components\core\core::$names;
        return $arr[$name] ?? \Components\Pages\error_page::showPageError(" not find name route {$name}",', code #361');
    }



    /**
     * @param string $url
     * @param bool $admin
     * @return string
     */


    public static function assets(string $url,$admin = false): string
    {
        $url = trim($url,'/');
        return $admin ?  Get::domen().'components/Admin/public/'.$url : Get::domen().'public/'.$url;
    }



    /**
     * @param $arr
     */
    public static function dump($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

}
