<?php


namespace Components\core;



class Route extends  createRoute
{

    public static function post(string $path, string $controller): createRoute
    {
        self::$typeRoute = 'post';
        self::createRoute($path,$controller);
        return new self();
    }


    public static function group(array $data,callable $function): void
    {
        $function();
    }

    public static function returnArrayRoutes(): array
    {
        self::includePageWithRoutes();

        return self::$arrRoutes;
    }

    public static function get(string $path, string $controller): createRoute
    {
        self::$typeRoute = 'get';
        self::createRoute($path,$controller);
        return new self();
    }

    public static function any(string $path, string $controller): createRoute
    {
        self::$typeRoute = 'any';
        self::createRoute($path,$controller);
        return new self();
    }



}