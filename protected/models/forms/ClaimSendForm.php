<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ClaimSendForm extends CFormModel
{
	public $fio;    
        public $phone;  
	public $email;
	public $subject='Оформление заявки';
	public $info;
        public $company;
        public $savemydata;
        public $verifyCode;
        public $nid;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('fio, phone, nid', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
                        array('company, info', 'safe'),
			// email has to be a valid email address
			//array('phone', 'phone'),                    
			// verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
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
			'verifyCode'=>Yii::t('form','Verification Code'),
                        'fio'=>Yii::t('form','FIO'),
                        'phone'=>Yii::t('form','Phone'),
                        'subject'=>Yii::t('form','Subject'),
                        'email'=>Yii::t('form','E-mail'),
                        'info'=>Yii::t('form','Info'),
                        'company'=>Yii::t('form','The company renter'),
                        'savemydata'=>Yii::t('form','Save My Data'), 
		);
	}
        

}