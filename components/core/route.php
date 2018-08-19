<?php


namespace Components\core;



class Route extends  createRoute
{


    public static function group(array $data,callable $function): void
    {
        $function();
    }

    public static function returnArrayRoutes(): array
    {
        self::includePageWithRoutes();

        return self::$arrRoutes;
    }

    public function name(string $name): void
    {
        $kek = array_keys(self::$arrRoutes);
        self::$arrRoutes[end($kek)]['name'] .= empty( self::$arrRoutes[end($kek)]['name']) ? $name : '.' . $name;
    }


    public static function get(string $path, string $controller): Route
    {
        self::$typeRoute = 'get';
        self::createRoute($path,$controller);
        return new self();
    }

    public static function post(string $path, string $controller): Route
    {
        self::$typeRoute = 'post';
        self::createRoute($path,$controller);
        return new self();
    }





}