<?php

/**
 * This is the model class for table "fsimilar_offers".
 *
 * The followings are the available columns in table 'fsimilar_offers':
 * @property integer $id
 * @property integer $init_value
 * @property integer $final_value
 * @property integer $approx
 * @property integer $sort
 * @property integer $act
 * @property integer $del
 * @property string $create_date
 * @property string $update_date
 * @property string $desc
 */
class FsimilarOffers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FsimilarOffers the static model class
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
		return 'fsimilar_offers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('init_value, final_value, approx, sort, act, del', 'numerical', 'integerOnly'=>true),
			array('create_date, update_date, desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, init_value, final_value, approx, sort, act, del, create_date, update_date, desc', 'safe', 'on'=>'search'),
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
			'init_value' => 'Init Value',
			'final_value' => 'Final Value',
			'approx' => 'Approx',
			'sort' => 'Sort',
			'act' => 'Act',
			'del' => 'Del',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'desc' => 'Desc',
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
		$criteria->compare('init_value',$this->init_value);
		$criteria->compare('final_value',$this->final_value);
		$criteria->compare('approx',$this->approx);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}