<?php
require_once 'config/listDerectoryAutoload.php';


class autoload
{

    private static $path;

    public static function autoload_class()
    {
        self::listDerictoryAutoload();

        spl_autoload_register(function ($class_name) {

            foreach (self::$path as $key) {
                $url = "$key/" . $class_name . '.php';
                if (is_file($url)) {
                    require_once $url;
                }
            }
        });
    }

    private static function listDerictoryAutoload(): void
    {
        if (empty(self::$path)) {
            $object = new listDerectoryAutoload();
            self::$path = $object->getListDirectory();
        }
    }
}
