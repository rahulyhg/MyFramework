<?php

namespace app\controllers\site\basket;

use Components\extension\infoPages\error_page;
use Components\extension\mail\mail;

class sendMailController
{

    private $data = [];

    public function run()
    {
        $this->data = json_decode($_GET['json'], true);

        $this->sendMailClient();

        $this->sendMailAdmin();
    }

    protected function sendMailClient()
    {
        try {
            $mail = new mail();
            $mail->sendMail('rain139@ukr.net', 'lol')
                ->subject('аіаа')
                ->body('wfe')->
                send();
        } Catch (\Exception $e) {
            error_page::showPageError('Mail not send!');
        }
    }

    protected function sendMailAdmin()
    {
        try {
            $mail = new mail();
            $mail->sendMail($mail->getSettings('adminEmail'))
                ->subject('аіаа')
                ->body('цуацу')->
                send();
        } Catch (\Exception $e) {
            error_page::showPageError('Mail not send!');
        }
    }
}