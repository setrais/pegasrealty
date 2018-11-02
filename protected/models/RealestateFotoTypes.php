<?php

/**
 * This is the model class for table "realestate_foto_types".
 *
 * The followings are the available columns in table 'realestate_foto_types':
 * @property integer $id
 * @property string $abbr
 * @property string $title
 * @property integer $sort
 * @property integer $act
 * @property integer $del
 * @property string $desc
 * @property string $date_create
 * @property string $date_update
 *
 * The followings are the available model relations:
 * @property RealestateFotos[] $realestateFotoses
 */
class RealestateFotoTypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RealestateFotoTypes the static model class
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
		return 'realestate_foto_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort, act, del', 'numerical', 'integerOnly'=>true),
			array('abbr, title', 'length', 'max'=>255),
			array('desc, date_create, date_update', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, abbr, title, sort, act, del, desc, date_create, date_update', 'safe', 'on'=>'search'),
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
			'realestateFotoses' => array(self::HAS_MANY, 'RealestateFotos', 'realestate_foto_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'abbr' => 'Abbr',
			'title' => 'Title',
			'sort' => 'Sort',
			'act' => 'Act',
			'del' => 'Del',
			'desc' => 'Desc',
			'date_create' => 'Date Create',
			'date_update' => 'Date Update',
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
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_update',$this->date_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}