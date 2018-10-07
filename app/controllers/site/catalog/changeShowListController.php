<?php

namespace app\controllers\site\catalog;

use Components\Controller;
use Components\extension\arr\Get;
use Components\extension\arr\Request;
use Components\extension\http\location;

class changeShowListController extends Controller
{

    public function changeView(Get $get): void
    {
        $_SESSION['catalog']['view'] = $get->last();
        location::back();
    }

    public function changeShowList(Get $get): void
    {
        $_SESSION['catalog']['list'] = $get->last() == 'block' ? 'block' : 'all';
        location::back();
    }

    public function filterPrice(Request $request)
    {
       $request = $request->all();
       location::href(self::route('site.cat.index')."/from={$request['from']}end={$request['end']}");
    }

}