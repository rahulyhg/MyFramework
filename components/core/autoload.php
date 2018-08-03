<?php
require_once 'components/core/derectoryAutoload.php';


class autoload
{

    private static $path;

    public static function autoload_class(): void
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
            $object = new derectoryAutoload();
            self::$path = $object->getListDirectory();
        }
    }
}
