<?php

class FrontendUserIdentity extends CUserIdentity
{
    const ERROR_NOT_AUTHENTICATED = 3;
    private $_id;
    private $_service;

    function __construct()
    {

        if (func_num_args() == 2)
        {
            parent::__construct(func_get_arg(0), func_get_arg(1));
        } else
        {
            $this->_service = func_get_arg(0);
        }
    }

    public function getId()
    {
        return $this->_id;
    }

    public function authenticate()
    {
        if (strstr($this->username, '@'))
        {
            $findByUsernameKey = 'email';
        } else
        {
            $findByUsernameKey = 'login';
        }

        $record = Clients::model()->findByAttributes(array($findByUsernameKey => $this->username, 'status' => true));

        if ($record === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($record->password !== sha1($this->password))
        {
            $pasw = $record->password;
            $mail = $record->email;
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else
        {
            $this->_id = $record->id;
            $this->setState('name', $record->getFullName());
            /**
             * Как только пользователь успешно войдёт в приложение, мы сможем получить его login,
             * используя Yii::app()->user->login.
             * При этом setState пихает данные в сессию, то есть при Yii::app()->user->login вызова к БД не будет.
             */
            $this->setState('login', $record->login);
            $this->errorCode = self::ERROR_NONE;
        }

        return!$this->errorCode;
    }

    public function authenticateByService()
    {
        if ($this->_service->isAuthenticated)
        {
            $this->username = $this->_service->getAttribute('name');
            $this->_id = $this->_service->id;
            $this->setState('name', $this->username);
            $this->setState('service', $this->_service->serviceName);
            $this->errorCode = self::ERROR_NONE;
        } else
        {
            $this->errorCode = self::ERROR_NOT_AUTHENTICATED;
        }
        return!$this->errorCode;
    }

}
