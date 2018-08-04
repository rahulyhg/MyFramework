<?php

namespace Components\core;


class sessions
{
    public static function session(...$arr)
    {
        return !empty($arr) ? self::searchKey(array_values($arr)) : new self();
    }

    private static function searchKey($arr, $ses = [])
    {
        $key = array_shift($arr);

        if (empty($ses)) {
            if (array_key_exists($key, $_SESSION)) {
                return self::searchKey($arr, $_SESSION[$key]);
            }
            return false;
        } elseif (is_array($ses)) {
            if (array_key_exists($key, $ses)) {
                return self::searchKey($arr, $ses[$key]);
            }
            return false;
        }

        return $ses;
    }

    public function add($key,$value): void
    {
        $_SESSION[$key] = $value;
    }

    public function all():array
    {
        return $_SESSION;
    }

}