<?php

namespace app\models;

use Components\db\models;

class currency extends models
{


    public static function getCurrency(): array
    {
        return self::select(['symbol','id'])->get();
    }


    public static function getGlobabalsVaribleInTwig(): array
    {
        return [
            'arr_currency' => self::getCurrency(),
            'currency' => self::getCurrencyDefault()
        ];
    }

    private static function getCurrencyDefault(): string
    {
        if(!session('currency')){
            $default_currency = session('lang.domen') == 'en' ? '$' : '₴';
            session()->add('currency',$default_currency);
        }
        return session('currency');
    }


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