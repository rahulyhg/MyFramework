<?php


namespace Components\extension\validate;


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
            session()->delete('message');
            return $alert;
        }
    }

    public static function setAlert(string $message,string $type)
    {
        session()->add('message',['alert' => $message,'type' => $type]);
    }

    public static function type()
    {
        if (session('message.alert')) {
            return session('message.type');
        }
    }
}