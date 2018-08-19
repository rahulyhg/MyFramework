<?php

namespace Components\extension;

class pagination
{


    public static $count_page = 0;

    private static $html;


    public static function calc_offset_for_pagination(int $count): int
    {
        return get('page') > 1 ? (get('page') - 1) * $count : 0;
    }

    public static function showPagination()
    {

        if (self::$count_page > 0) {

            self::$html = '<ul>';

            self::prev();

            self::pages();

            self::next();

            self::$html .='</ul>';

            return self::$html;
        }

    }

    private static function prev(): void
    {
        if (get('page') > 1) {
            $prev = get('page') - 1;
            self::$html .= "<li><a href='?page={$prev}'><<</a></li>";
        } else {
            self::$html .= "<li><<</li>";
        }
    }

    private static function pages(): void
    {

        for ($i = 1; $i <= self::$count_page; $i++) {

            self::$html .= self::conditionShowNumberPages($i) ? self::createLiPage($i) : "<li><a href='?page={$i}'>.</a></li>";

        }

    }

    private static function createLiPage($i): string
    {
        $html = "<li ";
        if (get('page') == $i) {
            $html .= " class='active' ";
        }
       $html .= "><a href='?page={$i}'>{$i}</a></li>";
        return $html;
    }

    private static function conditionShowNumberPages(int $i)
    {
        if(get('page') == $i || get('page')+ 1 == $i || get('page') + 2 == $i || $i <= 3 ||
            $i >= self::$count_page -1 || get('page') - 2 == $i || get('page') - 1 == $i){
            return true;
        }
    }

    private static function next(): void
    {
        if (get('page') < self::$count_page) {
            $next = get('page') + 1;
            self::$html .= "<li><a href='?page={$next}'>>></a></li>";
        } else {
            self::$html .= "<li>>></li>";
        }
    }

}