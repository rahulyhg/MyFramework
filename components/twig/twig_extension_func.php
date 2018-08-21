<?php


namespace Components\twig;

use Components\extension\{multiLang,pagination};



class twig_extension_func extends \Twig_Extension {

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('showPagination', [new pagination(), 'showPagination']),
            new \Twig_SimpleFunction('prefs', [new multiLang, 'prefs']),

        );
    }

    public function prefs($cnst)
    {
        return multiLang::prefs($cnst);
    }

    public function getName()
    {
        return 'menu';
    }
}