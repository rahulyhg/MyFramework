<?php


namespace app\middleware;

use app\models\currency;
use Components\core\treits\globalFunction;
use Components\extension\middleware\middlewareInterface;

class currencyMiddleware implements middlewareInterface
{
    use globalFunction;

    public function run(): void
    {
        currency::getCurrencyDefault();
    }

}