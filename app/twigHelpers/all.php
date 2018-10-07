<?php


namespace app\twigHelpers;


class all
{
    public function getFilterUrl(string $filter)
    {

        $url = preg_replace("~/from=([0-9]+)end=([0-9]+)~",'',parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));

        if(strrchr($url,'sort')){
            return  preg_replace('/sort=([a-z]+)/','', $url) . "sort=$filter";
        }

        return $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['SERVER_NAME']. $url . "/sort=$filter";
    }

    public function getSelectFilter()
    {
        preg_match('/[a-z]+$/',parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),$result);
        if(isset($result[0])) {
            switch ($result[0]) {
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
        }else{
            return 'З нових';
        }
    }

}