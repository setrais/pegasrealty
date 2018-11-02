<?php

/**
 * This is the model class for table "realestate_metros".
 *
 * The followings are the available columns in table 'realestate_metros':
 * @property integer $id
 * @property integer $realestate_id
 * @property integer $metro_id
 * @property integer $remoteness
 * @property integer $unit_id
 *
 * The followings are the available model relations:
 * @property Units $unit
 * @property Metros $metro
 * @property Realestates $realestate
 */
class RealestateMetros extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RealestateMetros the static model class
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
		return 'realestate_metros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('realestate_id, metro_id, remoteness, unit_id','required'),
			array('realestate_id, metro_id, remoteness, unit_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, realestate_id, metro_id, remoteness, unit_id', 'safe', 'on'=>'search'),
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
			'unit' => array(self::BELONGS_TO, 'Units', 'unit_id'),
			'metro' => array(self::BELONGS_TO, 'Metros', 'metro_id'),
			'realestate' => array(self::BELONGS_TO, 'Realestates', 'realestate_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'realestate_id' => Yii::t('label','Realestate'),
			'metro_id' => Yii::t('label','Metro'),
			'remoteness' => Yii::t('label','Remoteness'),
			'unit_id' => Yii::t('label','Unit'),
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
		$criteria->compare('realestate_id',$this->realestate_id);
		$criteria->compare('metro_id',$this->metro_id);
		$criteria->compare('remoteness',$this->remoteness);
		$criteria->compare('unit_id',$this->unit_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}