<?php


namespace app\twigHelpers;


class all
{
    public function getFilterUrl(string $filter)
    {
        if(strrchr($_SERVER['REQUEST_URI'],'sort')){
            return  preg_replace('/sort=([a-z]+)/','', $_SERVER['REQUEST_URI']) . "sort=$filter";
        }
        return $_SERVER['REQUEST_URI'] . "/sort=$filter";
    }

    public function getSelectFilter()
    {
        preg_match('/[a-z]+$/',$_SERVER['REQUEST_URI'],$result);
        switch ($result[0]){
            case 'cheap':
                return 'З дешевих';
                break;
            case 'expensive':
                return 'З дорогих';
                break;
            case 'rank':
                return 'По рейтингу';
                break;
            case 'action':
                return 'По акціям';
                break;
            default:
                return 'З нових';
        }
    }

}