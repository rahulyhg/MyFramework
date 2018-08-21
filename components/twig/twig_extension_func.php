<?php


namespace Components\twig;

use Components\Controller;
use Components\core\treits\globalFunction;
use Components\extension\{multiLang,pagination};



class twig_extension_func extends \Twig_Extension {

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('showPagination', [new pagination(), 'showPagination']),
            new \Twig_SimpleFunction('prefs', [multiLang::class, 'prefs']),
            new \Twig_SimpleFunction('assets',[globalFunction::class,'assets'])

        );
    }


}