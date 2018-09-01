<?php

namespace app\models;

use Components\db\models;
use Components\extension\validate;

/**
 * Class mailing
 * @package app\models
 */

class mailing extends  models
{

    public static function saveEmail($request): void
    {
        if(!empty($request['email']) && validate::email($request['email'])){
           self::insert(['email' => $request['email']]);
        }
    }
}