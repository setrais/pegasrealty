<?php

/**
 * This is the model class for table "space_representatives".
 *
 * The followings are the available columns in table 'space_representatives':
 * @property integer $id
 * @property integer $space_id
 * @property integer $representative_id
 *
 * The followings are the available model relations:
 * @property Spaces $space
 * @property Representatives $representative
 */
class SpaceRepresentatives extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SpaceRepresentatives the static model class
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
		return 'space_representatives';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('space_id, representative_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, space_id, representative_id', 'safe', 'on'=>'search'),
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
			'space' => array(self::BELONGS_TO, 'Spaces', 'space_id'),
			'representative' => array(self::BELONGS_TO, 'Representatives', 'representative_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'space_id' => 'Space',
			'representative_id' => 'Representative',
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
		$criteria->compare('space_id',$this->space_id);
		$criteria->compare('representative_id',$this->representative_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}