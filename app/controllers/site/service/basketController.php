<?php
namespace app\controllers\site\service;

use app\models\tovars;
use Components\Controller;

class basketController extends Controller
{

    private $id_count = [];

    public $tovars;

    private  static $total = 0;

    public function __construct()
    {
        $this->getTovarWithCookies();

        $this->getTovarBasket();
    }

    private function getTovarWithCookies()
    {
        foreach ($_COOKIE as $key=>$value){
            if(strrchr('cart_',$key)){
                $this->id_count[str_replace('cart_','',$key)] = $value;
            }
        }
    }

    public function getTovarBasket()
    {
        $this->tovars = tovars::getTovars(array_keys($this->id_count));
    }
    //count кожному товару

    public  function count(): int
    {
        return array_sum($this->id_count);
    }

    public  function total(): float
    {
        if(!self::$total){
            if($this->tovars){
                foreach ($this->tovars as $key=>$value){
                    self::$total += $value['price'];
                }
            }
        }

        return  self::$total;
    }

}