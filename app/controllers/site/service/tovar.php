<?php


namespace app\controllers\site\service;


class tovar
{

    public function newTovar(string $date): bool
    {
        $date = new \DateTime($date);
        return $date->diff(new \DateTime())->d < 7 ? true : false;
    }


    public function action(float $old_price,float $price): float
    {
        return ceil(($old_price - $price)/($old_price/100));
    }

}