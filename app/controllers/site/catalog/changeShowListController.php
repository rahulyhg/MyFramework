<?php

namespace app\controllers\site\catalog;

use Components\Controller;
use Components\extension\arr\Get;
use Components\extension\arr\Request;
use Components\extension\http\location;

class changeShowListController extends Controller
{

    public function changeView(): void
    {
        $_SESSION['catalog']['view'] = Get::last();
        location::back();
    }

    public function changeShowList(): void
    {
        $_SESSION['catalog']['list'] = Get::last() == 'block' ? 'block' : 'all';
        location::back();
    }

    public function filterPrice(Request $request)
    {
       $request = $request->all();
       location::href(self::route('site.cat.index').$this->categoryNumber()."/from={$request['from']}end={$request['end']}");
    }

    private function categoryNumber()
    {
        preg_match('~/cat=[0-9]+~',server('REQUEST_URI'),$matches);
        return isset($matches[0]) ? str_replace('/cat','',$matches[0]) : '';
    }
}