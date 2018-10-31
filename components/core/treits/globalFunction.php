<?php

namespace Components\core\treits;


use Components\core\core;
use Components\extension\infoPages\error_page;
use Components\extension\models\models;
use Components\extension\arr\Get;

trait globalFunction
{

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
     * @param string $file
     * @return string
     * @return string
     */


    public static function extens(string $file): string
    {
        $info = new \SplFileInfo($file);
        return $info->getExtension();
    }


    /**
     * @param string $name
     * @return string
     */


    public static function route(string $name): string
    {
        return core::$names[$name] ?? error_page::showPageError(" not find name route {$name}", ', code #361');
    }


    /**
     * @param string $url
     * @param bool $admin
     * @return string
     */


    public static function assets(string $url, $admin = false): string
    {
        $url = trim($url, '/');
        return $admin ? Get::domen() . 'components/Admin/public/' . $url : Get::domen() . 'public/' . $url;
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


    /**
     * @param array $arr
     * @param string $column
     * @return array
     */

    public static function json(array $arr, string $column)
    {
        foreach ($arr as $key => $value) {
            $arr[$key][$column] = json_decode($arr[$key][$column], true);
        }
        return $arr;
    }

    /**
     * @param array $arr
     * @param string $column
     * @param array $result
     * @return array
     */

    public static function changeKeyArr(array $arr, string $column, array $result = [])
    {
        foreach ($arr as $key => $value) {

            $result[$value['id']] = $value;

            $result[$value['id']][$column] = json_decode($result[$value['id']][$column], true);

        }

        return $result;
    }


    /**
     * @param string $name
     * @param string $path
     * @return bool
     */

    public function saveFile(string $name, string $path)
    {
        move_uploaded_file($_FILES[$name]['tmp_name'], $path . $_FILES[$name]['name']);

        return file_exists($path . $_FILES[$name]['name']) ? $path . $_FILES[$name]['name'] : false;
    }


}
