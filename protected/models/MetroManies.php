<?php

/**
 * This is the model class for table "merto_manies".
 *
 * The followings are the available columns in table 'merto_manies':
 * @property integer $id
 * @property integer $merto_id
 * @property integer $many_id
 *
 * The followings are the available model relations:
 * @property Manies $many
 * @property Metros $merto
 */
class MetroManies extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MertoManies the static model class
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
		return 'metro_manies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('metro_id, many_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, metro_id, many_id', 'safe', 'on'=>'search'),
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
			'many' => array(self::BELONGS_TO, 'Manies', 'many_id'),
			'metro' => array(self::BELONGS_TO, 'Metros', 'metro_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'metro_id' => 'Metro',
			'many_id' => 'Many',
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
		$criteria->compare('metro_id',$this->metro_id);
		$criteria->compare('many_id',$this->many_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}