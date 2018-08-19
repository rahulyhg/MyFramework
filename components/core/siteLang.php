<?php


namespace Components\core;
use Components\db\models;
use Components\core\core;

class siteLang
{

    private static $url;


    private $langsInSite = [];

    public function __construct()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        self::$url = parse_url($url,PHP_URL_PATH);
        $_SESSION['settings'] = $_SESSION['settings']  ?? models::siteSettings()->all()[0];
    }


    public function lang(): void
    {
        $this->createLangSession();
//зробити дефолт який некмає субдомена
        if (!preg_match("/en|uk|ru/", self::$url)) {

            header('Location: /' . $_SESSION['lang']['domen'] . '/' . self::$url);
        }

    }

    private function createLangSession(): void
    {
        $imposibleLang = models::lang()->where('visible', 1)->get();

        $userLang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE'])[0];

        foreach ($imposibleLang as $key => $value) {
            $this->langsInSite[] = $value['domen'];
            if (preg_match("/{$value['domen']}/i", $userLang) && !isset($_SESSION['lang'])) {
                $_SESSION['lang'] = ['domen' => $value['domen'], 'id' => $value['id']];
            }
        }
    }


}