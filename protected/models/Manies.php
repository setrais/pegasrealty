<?php

/**
 * This is the model class for table "manies".
 *
 * The followings are the available columns in table 'manies':
 * @property integer $id
 * @property string $sid
 * @property string $abbr
 * @property string $title
 * @property integer $sort
 * @property string $desc
 * @property integer $act
 * @property integer $del
 *
 * The followings are the available model relations:
 * @property MertoManies[] $mertoManies
 */
class Manies extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Manies the static model class
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
		return 'manies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('sort, act, del', 'numerical', 'integerOnly'=>true),
			array('sid, abbr, title', 'length', 'max'=>255),
			array('desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sid, abbr, title, sort, desc, act, del', 'safe', 'on'=>'search'),
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
			'mertoManies' => array(self::HAS_MANY, 'MertoManies', 'many_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sid' => 'Sid',
			'abbr' => 'Abbr',
			'title' => 'Title',
			'sort' => 'Sort',
			'desc' => 'Desc',
			'act' => 'Act',
			'del' => 'Del',
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
		$criteria->compare('abbr',$this->abbr,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}