<?php


namespace app\controllers;

use app\models\currency;
use Components\Controller;
use Components\extension\arr\Get;
use Components\extension\location;

class currencyController extends Controller
{
    public function changeCurrency(Get $get)
    {
        currency::changeCurrency($get->last());

        location::back();
    }

}