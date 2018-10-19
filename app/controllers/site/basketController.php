<?php
namespace app\controllers\site;

use app\models\tovars;
use Components\Controller;

class basketController extends Controller
{

    private $id_count = [];

    public $tovars = [];

    public $total = 0;

    public function __construct()
    {
        $this->getTovarWithCookies();

        $this->getTovarBasket();

        $this->deleteServiceCookie();
    }

    private function getTovarWithCookies(): void
    {
        foreach ($_COOKIE as $key => $value) {
            if (strrchr('cart_', $key)) {
                $this->id_count[str_replace('cart_', '', $key)] = $value;
            }
        }
    }

    private function deleteServiceCookie()
    {
        unset($this->id_count['__atuvc'], $this->id_count['__atuvs']);
    }


    public function getTovarBasket(): void
    {
        if ($this->id_count) {
            $tovars = tovars::getTovars(array_keys($this->id_count));
            $this->tovars = $this->changeArr($tovars);
        }
    }

    private function changeArr(array $tovars): array
    {
        foreach ($tovars as $key => $value) {
            $tovars[$key]['count'] = $this->id_count[$value['lid']] ?? 0;
            $this->total += $tovars[$key]['count'] * $value['price'];

        }
        return $tovars;
    }


    public function count(): int
    {
        return array_sum($this->id_count);
    }


    public function showMiniCart(): void
    {
        echo self::$twig->render('site/layouts/ajaxMiniCart.html.twig',[]);
    }



}