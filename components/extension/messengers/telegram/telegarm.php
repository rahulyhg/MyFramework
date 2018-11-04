<?php


namespace Components\extension\messengers\telegram;


class telegarm
{
    private const API = '740828408:AAHHPyrSCmwy9jBO8uCr76ogd1lW2bWpIyw';

    private const CHAT_ID = 406873185;

    private $text;

    public function message(string $text): telegarm
    {
        $this->text = $text;
        return $this;
    }

    public function send()
    {
        file_get_contents('https://api.telegram.org/bot' . self::API . '/sendMessage?chat_id=' . self::CHAT_ID . "&text={$this->text}");
    }
}