<?php


namespace Components\core;
use Components\db\models;
use Components\core\core;
use Components\extension\siteSettings;

class siteLang
{

    private static $url;


    private $langsInSite = [];

    public function __construct()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        self::$url = parse_url($url,PHP_URL_PATH);
    }


    public function lang(): void
    {
        $this->createLangSession();

        $this->refererIntoLocalization();

    }

    private function refererIntoLocalization(): void
    {
        if (!preg_match("/" . implode('|', $this->langsInSite) . "/", self::$url) && siteSettings::$settings['lang_default'] !== $_SESSION['lang']['domen']) {
            header('Location: /' . $_SESSION['lang']['domen'] . '/' . self::$url);
        }
    }


    private function createLangSession(): void
    {
        $imposibleLang = models::lang()->where('visible', 1)->get();

        $userLang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE'])[0];

        foreach ($imposibleLang as $key => $value) {

            $this->langsInSite[] = $value['domen'];

            if(preg_match("/".$value['domen']."/i",self::$url,$langWithUrl) || (preg_match("/{$value['domen']}/i", $userLang) && !isset($_SESSION['lang']))){

                $_SESSION['lang'] = ['domen' => $value['domen'], 'id' => $value['id']];

            }
        }
    }

}