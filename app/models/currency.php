<?php

namespace app\models;

use Components\extension\models\models;

/**
 * Class currency
 * @package app\models
 */

class currency extends models
{

    /**
     * @return array
     */

    public static function getCurrency(): array
    {
        return self::select(['symbol','id'])->where('visible',1)->get();
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

    private static function getCurrencyDefault(): string
    {
        if(!session('currency')){
            $default_currency = session('lang.domen') == 'en' ? '$' : '₴';
            session()->add('currency',$default_currency);
        }
        return session('currency');
    }


    /**
     * @param int $id_currency
     */

    public static function changeCurrency(int $id_currency): void
    {
        $currencys = currency::getCurrency();

        foreach ($currencys as $key=>$value){
            if($value['id'] == $id_currency){
                session()->add('currency',$value['symbol']);
                break;
            }
        }

    }




}