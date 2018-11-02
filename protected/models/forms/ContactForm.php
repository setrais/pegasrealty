<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
	public $name;
        public $phone;
	public $email;
	public $subject;
	public $body;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			//array('name, email, subject, body', 'required'),
                        array('phone', 'required','message'=>Yii::t('all','Укажите телефон.')),
                        array('name', 'required','message'=>Yii::t('all','Имя не может быть пустым.')),
                        array('subject', 'required','message'=>Yii::t('all','Введите в кратце тему сообщения.')),
                        array('body', 'required','message'=>Yii::t('all','Опишите суть Вашего обращения.')),
			// email has to be a valid email address
			array('email', 'email', 'message'=>Yii::t('all','Не корректный адрес.')),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(),'message'=>Yii::t('all','Код проверки введен не корректно.')),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Verification Code',
                        'name'=>Yii::t('form','Name'),
                        'phone'=>Yii::t('form','Phone'),
                        'subject'=>Yii::t('form','Subject'),
                        'email'=>Yii::t('form','E-mail'),
                        'body'=>Yii::t('form','Body'),
		);
	}
}