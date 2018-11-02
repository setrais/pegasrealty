<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    
   /**
    * Authenticates a user.
    * The example implementation makes sure if the username and password
    * are both 'demo'.
    * In practical applications, this should be changed to authenticate
    * against some persistent user identity storage (e.g. database).
    * @return boolean whether authentication succeeds.
    *
    public function authenticate()
    {
        $users=array(
            // username => password
            'demo'=>'demo',
            'admin'=>'as27061973',
        );
      
        if(!isset($users[$this->username]))
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($users[$this->username]!==$this->password)
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
            $this->errorCode=self::ERROR_NONE;
        return !$this->errorCode;
    }*/
        
    public function authenticate()
    {
        //echo md5($this->password);        
        
        $record=Users::model()->findByAttributes(array('username'=>$this->username));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;

        else if($record->password!==md5($this->password)) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        } else
        {
            $this->_id=$record->id;
            $this->setState('title', $record->title);                      
            //Yii::app()->phpBB->login($this->username,$this->password);
            //Yii::app()->phpBB->userAdd(	'blacks', 'blacks1204!', 'blacks@mail.ru' );
            
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
}