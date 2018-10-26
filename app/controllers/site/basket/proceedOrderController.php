<?php

namespace app\controllers\site\basket;

use app\models\currency;
use app\models\orders;
use Components\Controller;
use Components\extension\arr\Request;

class proceedOrderController extends Controller
{

    protected $request = [];

    public function toOrder(Request $request): void
    {
        $this->setRequest($request);

        $id = $this->saveOrder();

        $this->sendMailClient($id);

        $this->sendMailAdmin($id);

        $this->clearCart();
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

        unset($this->request['crsf']);

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
        $this->request['lang'] = lang();
    }

    private function setCurrency(): void
    {
        $this->request['currency'] = session('currency');
    }

    private function setUser(): void
    {
        $this->request['user'] = null;
    }


    protected function sendMailClient(int $id)
    {

    }

    protected function sendMailAdmin(int $id)
    {

    }

    protected function clearCart()
    {

    }

}