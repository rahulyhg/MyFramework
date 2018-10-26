<?php

namespace  Components\extension\mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mail
{

    private $mail;

    function __construct()
    {
        $this->mail = new PHPMailer(true);

        $this->allSettings();
    }

    private function allSettings(): void
    {
        $this->mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = 'egorkrushevskuy@gmail.com';        // SMTP username
        $this->mail->Password = 'samsung13130900';                  // SMTP password
        $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 587;                                    // TCP port to connect to
    }

    public function sendMail()
    {
        try {
            //Server settings


            //Recipients
            $this->mail->setFrom('egorkrushevskuy@gmail.com', 'Mailer');
            $this->mail->addAddress('rain139@ukr.net', 'Joe User');     // Add a recipient
            $this->mail->addAddress('rain139@ukr.net');               // Name is optional
            $this->mail->addReplyTo('info@example.com', 'Information');
            $this->mail->addCC('rain139@ukr.net');
            $this->mail->addBCC('rain139@ukr.net');

//            //Attachments
//            $this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'Here is the subject';
            $this->mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }
    }
}

