<?php
/**
 * Класс для работы с swiftMailer
 *
 * Пример (обычный текст):
 * <code>
 * Mailer::getInstance()
 *        ->setTo('debug@becar.ru')
 *        ->setSubject('subject')
 *        ->setText('text')
 *        ->send();
 * </code>
 *
 * @package system/mailers
 * @author Dmitriy Neshin
 */
class MyMailer extends CApplicationComponent
{
    public $subject;
    public $to;
    public $cc;
    public $view;
    public $data;
    public $text;

    public static function getInstance() {
        return new self();
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    public function setCc($cc) {
        $this->cc = $cc;
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    public function send() {
        spl_autoload_unregister(array('YiiBase', 'autoload'));
        include(dirname(__FILE__) . '/../../libs/vendor/swift/swift_required.php');
        spl_autoload_register(array('YiiBase', 'autoload'));

        $message = Swift_Message::newInstance()
                ->setSubject($this->subject)
                ->setFrom(Yii::app()->params['adminEmail'])
                ->setTo($this->to)
                ->setCc($this->cc);

        if ($this->view) {
            $message->setBody(MyMailer::renderView($this->view, $this->data), 'text/html', 'utf-8');
        } else {
            $message->setBody($this->text, 'text/plain');
        }

 /*       $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                ->setUsername('just.neshin')
                ->setPassword('qwaszxerdfcv');
*/        $transport = Swift_SmtpTransport::newInstance('smtp.yandex.ru')
                ->setUsername('valdemar.yakin')
                ->setPassword('778997'); 
//        $transport = Swift_SmtpTransport::newInstance();

        $mailer = Swift_Mailer::newInstance($transport);
        $mailer->send($message);
    }

    public static function renderView($view, $data)
    {
        $controller = Yii::app()->getController();
        $view_file = $controller->getViewFile('/mailer/'.$view);
		
        return $controller->renderPartial('application.views.frontend.mailer.'.$view, $data, true, false);
    }
}
