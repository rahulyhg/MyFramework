<?php


namespace Components\extension\twig;

use app\controllers\site\basketController;
use app\controllers\site\service\tovar;
use app\models\currency;
use app\models\lang;
use Components\core\treits\globalFunction;
use Components\extension\validate\validate;
use Components\extension\arr\Get;
use Components\extension\lang\multiLang;
use Components\extension\html\pagination;


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

        return $funct + config('twig_function');
    }

    public function getGlobals()
    {
        $project_variable = config('twig_extension');
        $arr = currency::getGlobabalsVaribleInTwig() + lang::getGlobalsVaribleLang() + self::otherVaribles();
        return is_array($project_variable) ? $arr + $project_variable : $arr;
    }

    private static function otherVaribles()
    {
        return [
            'session'       => $_SESSION,
            'site_name'     => Get::site(),
            'alert'         => new validate(),
            'cart'          => new basketController(),
            'prod'         => new tovar()
        ];
    }




}