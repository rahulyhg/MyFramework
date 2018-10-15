<?php


namespace app\twigHelpers;


use Components\core\treits\globalFunction;

class tovar
{

    use globalFunction;


    public function newTovar(string $date): bool
    {
        $date = new \DateTime($date);
        return $date->diff(new \DateTime())->d < 7 ? true : false;
    }


    public function action(float $old_price,float $price): float
    {
        return ceil(($old_price - $price)/($old_price/100));
    }

    public function exitsImg(string $img)
    {
        return file_exists(self::assets("images/products/{$img}")) ? self::assets("images/products/{$img}") : self::assets("images/404.jpg");
    }
}