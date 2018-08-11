<?php

namespace components\extension;

class pagination
{
    private static $count_rows;


    public static function countAllRows()
    {
        self::$count_rows = 1;
    }

    public static function calc_offset_for_pagination(int $count): int
    {
        return get('page') && get('name') > 1 ? (get('page') - 1) * $count : 0;
    }

}