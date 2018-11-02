<?php

class BackendUserIdentity extends CUserIdentity
{
    private $_id;

    public function authenticate()
    {
        $record = Users::model()->findByAttributes(array('login' => $this->username, 'status' => true));

        if ($record === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($record->password !== sha1($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $record->id;
            /**
             * Как только пользователь успешно войдёт в приложение, мы сможем получить его login,
             * используя Yii::app()->user->login.
             * При этом setState пихает данные в сессию, то есть при Yii::app()->user->login вызова к БД не будет.
             */
            $this->setState('login', $record->login);
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }
}
