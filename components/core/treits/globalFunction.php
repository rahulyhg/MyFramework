<?php

namespace Components\core\treits;

use Components\core\sessions;
use Components\Pages\error_page;
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

    public static function session(...$arr)
    {
        return sessions::session(...$arr);
    }


}
