<?php

namespace app\controllers\site\catalog;


use app\controllers\site\catalog\service\featuredTovar;
use app\models\category;
use app\models\tovars;
use Components\Controller;
use Components\extension\arr\Get;


class catalogController extends Controller
{

    private $data = "DESC";

    private $column = 'id';

    private $price = [];


    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */

    public  function show()
    {
        $categ = self::getIdCategory();
        echo self::$twig->render('site/pages/cat/index.html.twig', [
            'tovars' => $this->price ? tovars::tovarsWithFilterPrice($this->data, $this->column, $this->price, $categ) : tovars::getAllTovars($this->data, $this->column, $categ),
            'featured' => featuredTovar::get(),
            'show_tovars' => $_SESSION['catalog']['list'] ?? 'all',
            'urlPost'  => $this->urlPost(),
            'hideSlider' => $categ
        ]);
    }



    public static function urlPost()
    {
        $cat = self::getIdCategory(false);
        return $cat ? trim(self::route('site.cat.index'),'/') . "={$cat}/filterPrice" : self::route('site.cat.index') .'/filterPrice';

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
                $this->priceFromToEnd($get->last());
                break;
        }
        $this->show();
    }

    private static function getIdCategory($child = true)
    {
        preg_match('~cat=[0-9]+~',$_SERVER['REQUEST_URI'],$matches);

        if(isset($matches[0])){
            return $child ? category::childCategory(str_replace('cat=','',$matches[0])) : str_replace('cat=','',$matches[0]);
        }

        return false;
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

    private function priceFromToEnd(string $get)
    {
        $end =  str_replace('end=','',preg_replace('/from=[0-9]+/','',$get));
        $from =  str_replace('from=','',preg_replace('/end=[0-9]+/','',$get));

        $this->price = ['from' => $from,'to' => $end];
    }

}
