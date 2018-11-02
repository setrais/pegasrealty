<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $uid
 * @property string $title
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $send_email
 * @property string $register_date
 * @property string $lastvisit_date
 * @property string $description
 * @property integer $sort
 * @property integer $del
 * @property integer $act
 * @property string $create_date
 * @property string $update_date
 * @property integer $param_id
 * @property string $param_uid
 * @property string $phpBBLogin
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('username, password, email, title', 'required'),
			array('sort, del, act, param_id', 'numerical', 'integerOnly'=>true),
			array('uid, phpBBLogin', 'length', 'max'=>75),
			array('title', 'length', 'max'=>45),
			array('username, password, email, send_email, description, param_uid', 'length', 'max'=>255),
			array('register_date, lastvisit_date, create_date, update_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, title, username, password, email, send_email, register_date, lastvisit_date, description, sort, del, act, create_date, update_date, param_id, param_uid, phpBBLogin,usersRoles', 'safe', 'on'=>'search'),
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
                    'userRoles' => array(self::HAS_MANY, 'AuthAssignment', 'userid'),                        
                    'usersRoles' => array(self::MANY_MANY, 'AuthItem','auth_assignment(userid, itemname)'),                        
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'            => Yii::t('label','ID'),
			'uid'           => Yii::t('label','UID'),
			'title'         => Yii::t('label','Title'),
			'username'      => Yii::t('label','Username'),
			'password'      => Yii::t('label','Password'),
			'email'         => Yii::t('label','Email'),
			'send_email'    => Yii::t('label','Send Email'),
			'register_date' => Yii::t('label','Register Date'),
			'lastvisit_date'=> Yii::t('label','Lastvisit Date'),
			'description'   => Yii::t('label','Description'),
			'sort'          => Yii::t('label','Sort'),
			'del'           => Yii::t('label','Del'),
			'act'           => Yii::t('label','Act'),
			'create_date'   => Yii::t('label','Create Date'),
			'update_date'   => Yii::t('label','Update Date'),
			'param_id'      => Yii::t('label','Param'),
			'param_uid'     => Yii::t('label','Param Uid'),
			'phpBBLogin'    => Yii::t('label','Php Bblogin'),
                        'usersRoles'    => Yii::t('label','User Roles'),
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
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('send_email',$this->send_email,true);
		$criteria->compare('register_date',$this->register_date,true);
		$criteria->compare('lastvisit_date',$this->lastvisit_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('del',$this->del);
		$criteria->compare('act',$this->act);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('param_id',$this->param_id);
		$criteria->compare('param_uid',$this->param_uid,true);
		$criteria->compare('phpBBLogin',$this->phpBBLogin,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}