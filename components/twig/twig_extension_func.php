<?php


namespace Components\twig;

use app\models\currency;
use app\models\lang;
use Components\Controller;
use Components\core\treits\globalFunction;
use Components\extension\{
    arr\Get, multiLang, pagination
};


class twig_extension_func extends \Twig_Extension
{

    public function getFunctions()
    {
        $funct = array(
            new \Twig_SimpleFunction('showPagination', [new pagination(), 'showPagination']),
            new \Twig_SimpleFunction('prefs', [multiLang::class, 'prefs']),
            new \Twig_SimpleFunction('assets', [globalFunction::class, 'assets']),

        );
        return $funct + require_once 'config/twig_function.php';

    }

    public function getGlobals()
    {
        $project_variable = require_once 'config/twig_extension.php';
        $arr = currency::getGlobabalsVaribleInTwig() + lang::getGlobalsVaribleLang() + self::otherVaribles();
        return is_array($project_variable) ? $arr + $project_variable : $arr;
    }

    private static function otherVaribles()
    {
        return [
            'session' => $_SESSION,
            'site_name'  => Get::site()
        ];
    }


}