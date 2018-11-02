<?php

namespace app\models;

use Components\extension\models\models;

/**
 * Class currency
 * @package app\models
 */

class currency extends models
{

    private static $currency;

    /**
     * @return array
     */

    public static function getCurrency(): array
    {
        if(empty(self::$currency)){
            self::$currency = self::select(['symbol','id'])->where('visible',1)->get();
        }
        return self::$currency;
    }


    /**
     * @return array
     */

    public static function getGlobabalsVaribleInTwig(): array
    {
        return [
            'arr_currency' => self::getCurrency(),
            'currency' => self::getCurrencyDefault()
        ];
    }

    /**
     * @return string
     */

    public static function getCurrencyDefault(): string
    {
        if(!isset($_SESSION['currency'])){
            session()->add('currency',session('lang.domen') == 'uk' ? '₴': '$');
        }

        return session('currency');
    }


    /**
     * @param int $id_currency
     */

    public static function changeCurrency(int $id_currency): void
    {
        $currency = currency::getCurrency();

        foreach ($currency as $key=>$value){
            if($value['id'] == $id_currency){
                session()->add('currency',$value['symbol']);
                break;
            }
        }
    }
}