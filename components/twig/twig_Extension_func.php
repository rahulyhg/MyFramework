<?php
/**
 * Created by PhpStorm.
 * User: egor
 * Date: 19.08.18
 * Time: 18:21
 */

namespace Components\twig;

use Components\extension\{multiLang,pagination};



class twig_Extension_func extends \Twig_Extension {

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('showPagination', [new pagination(), 'showPagination']),
            new \Twig_SimpleFunction('prefs', [new multiLang, 'prefs']),

        );
    }

    public function prefs($cnst)
    {
        return $cnst;
    }

    public function getName()
    {
        return 'menu';
    }
}