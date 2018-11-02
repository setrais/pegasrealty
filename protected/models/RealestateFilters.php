<?php

/**
 * This is the model class for table "realestate_filters".
 *
 * The followings are the available columns in table 'realestate_filters':
 * @property string $id
 * @property string $aid
 * @property string $name_title
 * @property string $name_many
 * @property string $name_that
 * @property string $fomula
 * @property string $desc
 * @property string $uid
 * @property string $name
 */
class RealestateFilters extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RealestateFilters the static model class
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
		return 'realestate_filters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aid, name_title, name_many, name_that, name', 'required'),
			array('aid, name_title, name_many, name_that, name', 'length', 'max'=>255),
			array('uid', 'length', 'max'=>75),
			array('fomula, desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, aid, name_title, name_many, name_that, fomula, desc, uid, name', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'aid' => 'Aid',
			'name_title' => 'Name Title',
			'name_many' => 'Name Many',
			'name_that' => 'Name That',
			'fomula' => 'Fomula',
			'desc' => 'Desc',
			'uid' => 'Uid',
			'name' => 'Name',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('aid',$this->aid,true);
		$criteria->compare('name_title',$this->name_title,true);
		$criteria->compare('name_many',$this->name_many,true);
		$criteria->compare('name_that',$this->name_that,true);
		$criteria->compare('fomula',$this->fomula,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}