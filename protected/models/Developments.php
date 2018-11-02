<?php

/**
 * This is the model class for table "developments".
 *
 * The followings are the available columns in table 'developments':
 * @property integer $id
 * @property string  $abbr
 * @property string  $title
 * @property integer $sort
 * @property integer $act
 * @property integer $del
 * @property string  $createdate
 * @property string  $updatedate
 * @property string  $createuser
 * @property string  $updateuser 
 * @property string  $desc
 *
 * The followings are the available model relations:
 * @property ClientDevelopments[] $clientDevelopments
 */
class Developments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Developments the static model class
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
		return 'developments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort, act, del, createuser, updateuser', 'numerical', 'integerOnly'=>true),
			array('abbr, title', 'length', 'max'=>255),
			array('createdate, updatedate, desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, abbr, title, sort, act, del, createdate, updatedate, createuser, updateuser, desc', 'safe', 'on'=>'search'),
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
			'clientDevelopments' => array(self::HAS_MANY, 'ClientDevelopments', 'development_id'),
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
			'abbr' => Yii::t('label','Abbr'),
			'title' => Yii::t('label','Title'),
			'sort' => Yii::t('label','Sort'),
			'act' => Yii::t('label','Act'),
			'del' => Yii::t('label','Del'),
			'createdate' => Yii::t('label','Create Date'),
			'updatedate' => Yii::t('label','Update Date'),
                    	'createuser' => Yii::t('label','Createuser'),
			'updateuser' => Yii::t('label','Updateuser'),
			'desc' => Yii::t('label','Desc'),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('updatedate',$this->updatedate,true);
                $criteria->compare('createuser',$this->createuser);
		$criteria->compare('updateuser',$this->updateuser);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}