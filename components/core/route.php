<?php


namespace Components\core;


/**
 * Class Route
 * @package Components\core
 */

class Route extends  createRoute
{

    /**
     * @param array $data
     * @param callable $function
     */
    public static function group(array $data,callable $function): void
    {
        $function();
    }


    /**
     * @return array
     */
    public static function returnArrayRoutes(): array
    {
        self::includePageWithRoutes();

        return self::$arrRoutes;
    }


    /**
     * @param string $name
     */

    public function name(string $name): void
    {
        $kek = array_keys(self::$arrRoutes);
        self::$arrRoutes[end($kek)]['name'] .= empty( self::$arrRoutes[end($kek)]['name']) ? $name : '.' . $name;
    }


    /**
     * @param string $path
     * @param string $controller
     * @return Route for ->name()
     */

    public static function get(string $path, string $controller): Route
    {
        self::$typeRoute = 'get';
        self::createRoute($path,$controller);
        return new self();
    }

    /**
     * @param string $path
     * @param string $controller
     * @return Route for ->name()
     */
    public static function post(string $path, string $controller): Route
    {
        self::$typeRoute = 'post';
        self::createRoute($path,$controller);
        return new self();
    }
}