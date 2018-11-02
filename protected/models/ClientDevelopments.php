<?php

/**
 * This is the model class for table "client_developments".
 *
 * The followings are the available columns in table 'client_developments':
 * @property integer $id
 * @property integer $client_id
 * @property integer $development_id
 * @property string  $desc
 * @property integer $sort
 * @property integer $act
 * @property integer $del
 * @property string  $createdate
 * @property string  $updatedate
 * @property string  $createuser
 * @property string  $updateuser 
 *
 * The followings are the available model relations:
 * @property Developments $development
 * @property Clients $client
 */
class ClientDevelopments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ClientDevelopments the static model class
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
		return 'client_developments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_id, createuser, updateuser, development_id, sort, act, del', 'numerical', 'integerOnly'=>true),
			array('desc, createdate, updatedate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, client_id, development_id, desc, sort, act, del, createuser, updateuser, createdate, updatedate', 'safe', 'on'=>'search'),
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
			'development' => array(self::BELONGS_TO, 'Developments', 'development_id'),
			'client' => array(self::BELONGS_TO, 'Clients', 'client_id'),
                        'updateUser' => array(self::BELONGS_TO, 'Users', 'updateuser'),
                        'createUser' => array(self::BELONGS_TO, 'Users', 'createuser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'client_id' => Yii::t('label','Client'),
			'development_id' => Yii::t('label','Development'),
			'desc' => Yii::t('label','Desc'),
			'sort' => Yii::t('label','Sort'),
			'act' => Yii::t('label','Act'),
			'del' => Yii::t('label','Del'),
			'createdate' => Yii::t('label','Create Date'),
			'updatedate' => Yii::t('label','Update Date'),
                        'createuser' => Yii::t('label','Createuser'),
			'updateuser' => Yii::t('label','Updateuser'),
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
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('development_id',$this->development_id);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('updatedate',$this->updatedate,true);
                $criteria->compare('createuser',$this->createuser);
		$criteria->compare('updateuser',$this->updateuser);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}