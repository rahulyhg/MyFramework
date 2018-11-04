<?php

namespace app\controllers\site\basket;

use app\models\orders;
use Components\Controller;
use Components\extension\arr\Request;
use Components\extension\http\location;
use Components\extension\messengers\telegram\telegarm;


class proceedOrderController extends Controller
{

    protected $request = [];

    public function toOrder(Request $request): void
    {
        $this->setRequest($request);

        $id = $this->saveOrder();

        $this->sendMail();

        $this->sendTelegram();

        $this->clearCart();

        location::href(self::route('site.page.success'));
    }

    protected function setRequest(Request $request): void
    {
        $this->request = $request->all();
    }

    protected function saveOrder(): int
    {
        $basket = new miniBasketController();

        $this->setProducts($basket);

        $this->setTotal($basket);

        $this->setTotalAll();

        $this->setLang();

        $this->setCurrency();

        $this->setUser();

        $this->deleteServiseKey();

        return orders::insert($this->request);
    }

    private function setProducts(miniBasketController $basket): void
    {
        $cart = $basket->getCart();
        $products = [];

        foreach ($cart as $key=>$value){
            $products[$value['lid']] = $value['count'];
        }

        $this->request['products'] = json_encode($products);
    }

    private function setTotal(miniBasketController $basket): void
    {
        $this->request['total'] = $basket->getTotal();
    }

    private function setTotalAll(): void
    {
        $this->request['total_all'] = $this->request['total'] + $this->request['shipping'];
    }

    private function setLang(): void
    {
        $this->request['lang'] = lang_domen();
    }

    private function setCurrency(): void
    {
        $this->request['currency'] = currency();
    }

    private function setUser(): void
    {
        $this->request['user'] = null;
    }

    private function deleteServiseKey(): void
    {
        unset($this->request['crsf']);
    }

    private function sendTelegram(): void
    {
        (new telegarm())->message('NEW ORDER')->send();
    }
//checked in servers
    private function sendMail()
    {
        shell_exec("/usr/local/bin/wget http://myframework/uk/basket/sendMail?json=".urlencode(json_encode($this->request)));
    }

    protected function clearCart()
    {
        foreach ($_COOKIE as $key => $value) {
            if (strrchr('cart_', $key)) {
                setcookie($key, null, -1, '/');
            }
        }
    }

}