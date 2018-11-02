<?php

/**
 * This is the model class for table "partners".
 *
 * The followings are the available columns in table 'partners':
 * @property integer $id
 * @property string $abbr
 * @property string $uid
 * @property integer $act
 * @property integer $del
 * @property string $title
 * @property integer $sort
 * @property string $anons
 * @property string $infocode
 * @property string $ddog
 * @property string $ndog
 * @property string $site
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $contact
 * @property string $login
 * @property string $password
 * @property string $mypage
 * @property string $create_date
 * @property integer $create_user
 * @property string $update_date
 * @property integer $update_user
 * @property string $desc
 * @property integer $logo_id
 * @property integer $client_type_id
 * @property integer $client_id
 *
 * The followings are the available model relations:
 * @property ClientTypes $clientType
 * @property Users $updateUser
 * @property Users $createUser
 * @property Clients $client
 * @property Files $logo
 */
class Partners extends CActiveRecord
{        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Partners the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'partners';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('act, del, sort, create_user, update_user, logo_id, client_type_id, client_id', 'numerical', 'integerOnly'=>true),
			array('abbr, uid', 'length', 'max'=>75),
			array('title, site, email, address, mypage', 'length', 'max'=>255),
			array('ndog', 'length', 'max'=>10),
			array('phone, login, password', 'length', 'max'=>25),
			array('contact', 'length', 'max'=>125),
			array('anons, infocode, ddog, create_date, update_date, desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, abbr, uid, act, del, title, sort, anons, infocode, ddog, ndog, site, email, phone, address, contact, login, password, mypage, create_date, create_user, update_date, update_user, desc, logo_id, client_type_id, client_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'clientType' => array(self::BELONGS_TO, 'ClientTypes', 'client_type_id'),
			'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user'),
			'createUser' => array(self::BELONGS_TO, 'Users', 'create_user'),
			'client' => array(self::BELONGS_TO, 'Clients', 'client_id'),
			'logo' => array(self::BELONGS_TO, 'Files', 'logo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
		      'abbr' => Yii::t('label','Sid'),
                       'uid' => Yii::t('label','UID'),
		       'act' => Yii::t('label','Act'),
		       'del' => Yii::t('label','Del'),
		     'title' => Yii::t('label','Title'),
		      'sort' => Yii::t('label','Sort'),
		     'anons' => Yii::t('label','Anons'),
		  'infocode' => Yii::t('label','Infocode'),
		      'ddog' => Yii::t('label','Ddog'),
		      'ndog' => Yii::t('label','Ndog'),
                   'contact' => Yii::t('label','Contact Person'),
                     'phone' => Yii::t('label','Phone'),
                     'email' => Yii::t('label','Email'),
                      'site' => Yii::t('label','Site'),
                   'address' => Yii::t('label','Address'),                       
                     'login' => Yii::t('label','Login'),
                  'password' => Yii::t('label','Password'),
		    'mypage' => Yii::t('label','Mypage'),
               'create_date' => Yii::t('label','Create Date'),
	       'update_date' => Yii::t('label','Update Date'),
               'create_user' => Yii::t('label','Createuser'),
               'update_user' => Yii::t('label','Updateuser'),
		      'desc' => Yii::t('label','Desc'),
		   'logo_id' => Yii::t('label','Logo'),
	    'client_type_id' => Yii::t('label','Client Type'),
		 'client_id' => Yii::t('label','Client'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('abbr',$this->abbr,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('anons',$this->anons,true);
		$criteria->compare('infocode',$this->infocode,true);
		$criteria->compare('ddog',$this->ddog,true);
		$criteria->compare('ndog',$this->ndog,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('mypage',$this->mypage,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('create_user',$this->create_user);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('update_user',$this->update_user);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('logo_id',$this->logo_id);
		$criteria->compare('client_type_id',$this->client_type_id);
		$criteria->compare('client_id',$this->client_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getInfoCode() {
            if (strpos($this->infocode,'script')===false) 
                return CHtml::script("document.write('".HFormat::full_trim(str_replace("'",'"',$this->infocode))."');");
            else 
                return $this->infocode;
        }
}