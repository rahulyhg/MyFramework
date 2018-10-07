<?php

namespace app\controllers\site\catalog;


use app\controllers\site\catalog\service\featuredTovar;
use app\models\tovars;
use Components\Controller;
use Components\extension\arr\Get;


class catalogController extends Controller
{

    private $data = "DESC";

    private $column = 'id';

    private $price = [];

    /**
     * @param bool $categ
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

    public function show(bool $categ = false)
    {
        echo self::$twig->render('site/pages/cat/index.html.twig', [
            'tovars' => $categ ? [] : tovars::getAllTovars($this->data,$this->column,$this->price),
            'featured' => featuredTovar::get(),
            'show_tovars' => $_SESSION['catalog']['list'] ?? 'all'
        ]);
    }

    /**
     * @param Get $get
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

    public function filter(Get $get)
    {
        switch ($this->getFilter($get)){
            case 'cheap':
                $this->dataAndColumn('price','ASC');
                break;
            case 'expensive':
                $this->dataAndColumn('price','DESC');
                break;
            case 'rank':
                //$this->dataAndColumn('rating','ASC');
                break;
            case 'action':
                $this->dataAndColumn('old_price','DESC');
                break;
            case 'price' :
                $this->priceFromToEnd();
                break;
        }

        $this->show(preg_match('~cat/([0-9]+)/~',$_SERVER['REQUEST_URI']));
    }

    private function dataAndColumn(string $column,string $data)
    {
        $this->column = $column;
        $this->data = $data;
    }

    private function getFilter(Get $get)
    {
        return strrchr('from',$get->last()) ? 'price' : str_replace('sort=','',$get->last());
    }

    private function priceFromToEnd()
    {
        $this->price = ['from' => 0,'to' => 100];
    }

}
