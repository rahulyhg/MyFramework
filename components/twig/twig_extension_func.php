<?php


namespace Components\twig;

use app\models\currency;
use app\models\lang;
use Components\Controller;
use Components\core\treits\globalFunction;
use Components\extension\{
    arr\Get, multiLang, pagination, validate
};


class twig_extension_func extends \Twig_Extension
{

    public function getFunctions()
    {
        $funct = [
            new \Twig_SimpleFunction('showPagination', [new pagination(), 'showPagination']),
            new \Twig_SimpleFunction('prefs', [multiLang::class, 'prefs']),
            new \Twig_SimpleFunction('assets', [globalFunction::class, 'assets']),
            new \Twig_SimpleFunction('dump', [globalFunction::class, 'dump']),
            new \Twig_SimpleFunction('search_str', [twig_funct::class,'search_str']),
            new \Twig_SimpleFunction('route', [globalFunction::class,'route']),
            new \Twig_SimpleFunction('isset',[twig_funct::class,'isset']),
        ];

        return $funct + require 'config/twig_function.php';
    }

    public function getGlobals()
    {
        $project_variable = require 'config/twig_extension.php';
        $arr = currency::getGlobabalsVaribleInTwig() + lang::getGlobalsVaribleLang() + self::otherVaribles();
        return is_array($project_variable) ? $arr + $project_variable : $arr;
    }

    private static function otherVaribles()
    {
        return [
            'session'       => $_SESSION,
            'site_name'     => Get::site(),
            'alert'         => new validate()
        ];
    }




}