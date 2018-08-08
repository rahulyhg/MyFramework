<?php

namespace Components\core\treits;


use Components\db\models;


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

    //знайти значення в багатовимірному масиві, з строки масива значень
    public static function searchKey($arr, $ses = [])
    {
        $key = array_shift($arr);

        if (empty($ses)) {
            if (array_key_exists($key, $_SESSION)) {
                return self::searchKey($arr, $_SESSION[$key]);
            }
            return false;
        } elseif (is_array($ses)) {
            if (array_key_exists($key, $ses)) {
                return self::searchKey($arr, $ses[$key]);
            }
            return false;
        }

        return $ses;
    }

}
