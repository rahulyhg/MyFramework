<?php

namespace Components\extension\localization;



use app\models\lang;
use Components\extension\models\models;
use Components\siteSettings;


/**
 * Class siteLang
 * @package Components\core
 */


class siteLang
{

    private static $url;


    /**
     * @var array
     */

    public static $langsInSite = [];


    private static $langUrl;



    private function __construct()
    {

    }

    public static function lang(): void
    {
        self::getUrl();

        self::createLangSession();

        self::refererIntoLocalization();
    }

    private static function getUrl(): void
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        self::$url = parse_url($url, PHP_URL_PATH);
        $url = explode('/',self::$url);
        self::$langUrl = $url[0].'/';
    }


    private static function refererIntoLocalization(): void
    {
        if (!preg_match("~^".implode('|',self::$langsInSite)."$~i", self::$langUrl) && siteSettings::$settings['lang_default'] !== $_SESSION['lang']['domen']) {
            header('Location: /' . $_SESSION['lang']['domen'] . '/' . self::$url);
        }
    }


    private static function createLangSession(): void
    {

        $imposibleLang = lang::getLang();

        $userLang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE'])[0];

        foreach ($imposibleLang as $key => $value) {

            self::$langsInSite[] = $value['domen'] . '/';

            if (preg_match("~^" . $value['domen'] . "/$~i", self::$langUrl, $langWithUrl) || (preg_match("~{$value['domen']}~i", $userLang) && !isset($_SESSION['lang']))) {

                $_SESSION['lang'] = ['domen' => $value['domen'], 'id' => $value['id']];

            }
        }
    }

}