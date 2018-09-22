<?php


namespace app\controllers\site\service;

use app\models\currency;
use Components\Controller;
use Components\extension\arr\Get;
use Components\extension\http\location;

class currencyController extends Controller
{
    public function changeCurrency(Get $get)
    {
        currency::changeCurrency($get->last());

        location::back();
    }

}