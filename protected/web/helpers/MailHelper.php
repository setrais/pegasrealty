<?php
class MailHelper
{
    public function SendMail($to, $subject, $body, $files){
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->IsSMTP();
        $mailer->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mailer->SMTPAuth = true; // authentication enabled
        $mailer->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mailer->Host = Yii::app()->params['smtp_host'];
        $mailer->Port = Yii::app()->params['smtp_port'];
        $mailer->Username = Yii::app()->params['smtp_username'];
        $mailer->Password = Yii::app()->params['smtp_password'];
        $mailer->From = Yii::app()->params['email'];
        $mailer->AddReplyTo(Yii::app()->params['email']);
        $mailer->AddAddress($to);
        $mailer->FromName = Yii::app()->params['email_from_name'];
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = $subject;
        $mailer->Body = $body;
        //$mailer->ContentType = 'text/html';
        foreach($files as $file => $attach_name)
            $mailer->AddAttachment($file,$attach_name);

        $mailer->Send();
    }
}