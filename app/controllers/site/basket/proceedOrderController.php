<?php

namespace app\controllers\site\basket;

use Components\Controller;
use Components\extension\arr\Request;

class proceedOrderController extends Controller
{

    protected $request = [];

    public function toOrder(Request $request)
    {
        $this->setRequest($request);

        $this->saveOrder();

        $this->sendMailClient();

        $this->sendMailAdmin();

        $this->clearCart();
    }

    protected function setRequest(Request $request): void
    {
        $this->request = $request->all();
    }

    protected function saveOrder()
    {

    }

    protected function sendMailClient()
    {

    }

    protected function sendMailAdmin()
    {

    }

    protected function clearCart()
    {

    }

}