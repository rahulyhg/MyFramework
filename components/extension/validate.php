<?php


namespace Components\extension;


class validate
{

    public static function email(string $email): bool
    {
        return strlen($email) < 35 && filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    public static function getAlert()
    {
        if (session('message.alert')) {
            $alert = session('message.alert');
            session()->delete('message.alert');
            return $alert;
        }
    }

    public static function setAlert(string $message,string $type = '')
    {
        session()->add('message',['alert' => $message]);
    }

}