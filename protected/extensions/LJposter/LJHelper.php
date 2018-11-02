<?php
require('IXR_Library.php');

class LJHelper {
    
    public $lj_host = 'www.livejournal.com';
    private $_lj_path = '/interface/xmlrpc';
    public $login;
    public $pass;
    public $subject;
    public $text;
    private $_ljClient;
    private $_ljArgs;

    public function __construct($login, $pass)
    {
        $this->login = $login;
        $this->pass = $pass;
            // Создаем xml-rpc клиента
        $this->_ljClient = new IXR_Client($this->lj_host, $this->_lj_path);
        
            // Посылаем challange-запрос (что такое - читайте ниже)
        if (!$this->_ljClient->query('LJ.XMLRPC.getchallenge')) {
        echo 'Ошибка [' . $this->_ljClient->getErrorpre().'] '.$this->_ljClient->getErrorMessage();
        }
        else {
            // Получаем ответ
            $ljResponse = $this->_ljClient->getResponse();
            // Вытягиваем challenge
            $ljChallenge = $ljResponse['challenge'];
        
            // Заполняем поля XML-запроса
            $this->_ljArgs = array();
            // Имя пользователя
            $this->_ljArgs['username']       = $this->login;
            // Указываем способ идентификации
            $this->_ljArgs['auth_method']    = 'challenge';
            // Указываем полученный challenge
            $this->_ljArgs['auth_challenge'] = $ljChallenge;
            // Посылаем зафрованный пароль
            // формула md5(challenge + md5(password))
            $this->_ljArgs['auth_response']  = md5($ljChallenge . md5($this->pass));
            // Версия протокола, 1 - все данные в кодировке UTF-8
            $this->_ljArgs['ver']            = '1';
            // Текст записи (перекодируем из windows-1251 в UTF-8)

        
            // Дата
            $this->_ljArgs['year']           = date('Y'); // год
            $this->_ljArgs['mon']            = date('m'); // месяц
            $this->_ljArgs['day']            = date('d'); // день
            $this->_ljArgs['hour']           = date('H'); // часы
            $this->_ljArgs['min']            = date('i'); // минуты

            // Доп параметры
            $this->_ljArgs['props']          = array(
                // Текст уже отформатирован (содержит HTML-теги)
                'opt_preformatted' => true,
                // Добавляем запись &quot;задним числом&quot;
                'opt_backdated'    => true,
                //'taglist'          => iconv('windows-1251', 'UTF-8', 'список тегов (меток), разделенный запятыми'),
            );
        
            // Доступность записи - доступна всем (по-умолчанию)
            $this->_ljArgs['security']       = 'public';
        
            // Добавляем новое сообщение

        }
    }
    
    public function post()
    {
        $ljMethod = 'LJ.XMLRPC.postevent';
        $this->_ljArgs['event']          = $this->text;//iconv('windows-1251', 'UTF-8', 'текст записи');
        // Заголовок записи (перекодируем из windows-1251 в UTF-8)
        $this->_ljArgs['subject']        = $this->subject; //iconv('windows-1251', 'UTF-8', 'заголовок');
        //var_dump($this->_ljArgs);
        // Посылаем запрос
        if (!$this->_ljClient->query($ljMethod, $this->_ljArgs)) {
            echo 'Ошибка ['.$this->_ljClient->getErrorpre().'] '.$this->_ljClient->getErrorMessage();
        }
        else {
            // Получаем ответ
            $ljResponse = $this->_ljClient->getResponse();
            //print_r($ljResponse);
        }
    }
}