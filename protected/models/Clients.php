<?php

/**
 * This is the model class for table "clients".
 *
 * The followings are the available columns in table 'clients':
 * @property integer $id
 * @property string $sid
 * @property integer $status_id
 * @property integer $scope_id
 * @property integer $site_vids_id
 * @property integer $client_type_id
 * @property integer $email_types_id
 * @property integer $phone_types_id
 * @property integer $sort
 * @property integer $act
 * @property integer $del
 * @property string $create_date
 * @property string $update_date
 * @property integer $create_user
 * @property integer $update_user
 * @property string $desc
 * @property string $contact_person
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $site
 * @property string $address
 * @property string $contacts
 *
 * The followings are the available model relations:
 * @property ClientContacts[] $clientContacts
 * @property ClientDevelopments[] $clientDevelopments
 * @property ClientOrders[] $clientOrders
 * @property ClientRealestates[] $clientRealestates
 * @property SiteVids $siteVids
 * @property ClientTypes $clientType
 * @property ClientScopes $scope
 * @property ClientStatus $status
 * @property EmailTypes $emailTypes
 * @property PhoneTypes $phoneTypes
 */
class Clients extends CActiveRecord
{
        public $contact;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Clients the static model class
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
		return 'clients';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('status_id, scope_id, site_vids_id, client_type_id, 
                               email_types_id, phone_types_id, sort, act, del, update_user, create_user',
                              'numerical', 'integerOnly'=>true),
			array('sid, phone', 'length', 'max'=>75),
			array('contact_person, name, email, site', 'length', 'max'=>255),
			array('create_date, update_date, desc, address, contacts', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sid, status_id, scope_id, site_vids_id, client_type_id, 
                               email_types_id, phone_types_id, sort, act, del, create_date, create_user, 
                               update_date, update_user, desc, contact_person, name, phone, email, site, 
                               address, contacts', 'safe', 'on'=>'search'),
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
			'clientContacts' => array(self::HAS_MANY, 'ClientContacts', 'clients_id'),
			'clientDevelopments' => array(self::HAS_MANY, 'ClientDevelopments', 'client_id'),
			'clientOrders' => array(self::HAS_MANY, 'ClientOrders', 'client_id'),
			'clientRealestates' => array(self::HAS_MANY, 'ClientRealestates', 'client_id'),
			'siteVids' => array(self::BELONGS_TO, 'SiteVids', 'site_vids_id'),
			'clientType' => array(self::BELONGS_TO, 'ClientTypes', 'client_type_id'),
			'scope' => array(self::BELONGS_TO, 'ClientScopes', 'scope_id'),
			'status' => array(self::BELONGS_TO, 'ClientStatus', 'status_id'),
			'emailTypes' => array(self::BELONGS_TO, 'EmailTypes', 'email_types_id'),
			'phoneTypes' => array(self::BELONGS_TO, 'PhoneTypes', 'phone_types_id'),
                        'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user'),
                        'createUser' => array(self::BELONGS_TO, 'Users', 'create_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                => Yii::t('label','ID'),
			'sid'               => Yii::t('label','Sid'),
			'status_id'         => Yii::t('label','Status'),
			'scope_id'          => Yii::t('label','Scope'),
			'site_vids_id'      => Yii::t('label','Site Vids'),
			'client_type_id'    => Yii::t('label','Client Type'),
			'email_types_id'    => Yii::t('label','Email Types'),
			'phone_types_id'    => Yii::t('label','Phone Types'),
			'sort'              => Yii::t('label','Sort'),
			'act'               => Yii::t('label','Act'),
			'del'               => Yii::t('label','Del'),
			'create_date'       => Yii::t('label','Create Date'),
			'update_date'       => Yii::t('label','Update Date'),
                        'create_user'       => Yii::t('label','Createuser'),
                        'update_user'       => Yii::t('label','Updateuser'),
			'desc'              => Yii::t('label','Desc'),
			'contact_person'    => Yii::t('label','Contact Person'),
			'name'              => Yii::t('label','Name'),
			'phone'             => Yii::t('label','Phone'),
			'email'             => Yii::t('label','Email'),
			'site'              => Yii::t('label','Site'),
			'address'           => Yii::t('label','Address'),
			'contacts'          => Yii::t('label','Contacts'),
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
		$criteria->compare('sid',$this->sid,true);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('scope_id',$this->scope_id);
		$criteria->compare('site_vids_id',$this->site_vids_id);
		$criteria->compare('client_type_id',$this->client_type_id);
		$criteria->compare('email_types_id',$this->email_types_id);
		$criteria->compare('phone_types_id',$this->phone_types_id);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
                //$criteria->compare('create_date',$this->create_date,true);
		//$criteria->compare('update_date',$this->update_date,true);
                if ($this->create_date) {
                    $criteria->compare('create_date',  date('Y-m-d',  strtotime($this->create_date)),true);
                }
                if ($this->update_date) {
                    $criteria->compare('update_date',date('Y-m-d',  strtotime($this->update_date)),true);
                }
                $criteria->compare('create_user',$this->create_user);
		$criteria->compare('update_user',$this->update_user);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('contact_person',$this->contact_person,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('contacts',$this->contacts,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getStatusIcon() {
            return $this->status ? CHtml::image('/images/icons/status/client-'.$this->status->abbr.'.png', $this->status->title, array('title'=>$this->status->title) ) : '';
        }
}