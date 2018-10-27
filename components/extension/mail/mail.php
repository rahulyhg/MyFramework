<?php

namespace Components\extension\mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mail
{
    /**
     * @var PHPMailer
     */
    public $mail;

    private $config;

    function __construct()
    {
        $this->setConfig();

        $this->setMail();

        $this->allSettings();
    }


    private function setMail(): void
    {
        $this->mail = new PHPMailer(true);
    }

    private function setConfig(): void
    {
        $this->config = config('mailer');
    }

    private function allSettings(): void
    {
        $this->mail->CharSet = 'utf-8';
        $this->mail->SMTPDebug = 0; //2
        $this->mail->isSMTP();
        $this->mail->Host = $this->config['host'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $this->config['user'];
        $this->mail->Password = $this->config['password'];
        $this->mail->SMTPSecure = $this->config['SMTPSecure'];
        $this->mail->Port = $this->config['port'];
    }

    /**
     * @return mail
     * @throws Exception
     * @var string $email
     * @var string $name
     */

    public function sendMail(string $email = '',string $name = ''): mail
    {
        $this->mail->setFrom($this->config['adminEmail'], $this->config['nameCompany']);
        $this->mail->addAddress($email, $name);
        $this->mail->isHTML(true);
        return $this;
    }

    public function subject(string $subject): mail
    {
        $this->mail->Subject = $subject;
        return $this;
    }

    public function body(string $body): mail
    {
        $this->mail->Body = $body;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function send(): string
    {
        return $this->mail->send();
    }

    public function getSettings($key = '')
    {
        return $key && isset($this->config[$key]) ? $this->config[$key] : $this->config;
    }
}

