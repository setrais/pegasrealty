<?php

/**
 * This is the model class for table "iblocks_many".
 *
 * The followings are the available columns in table 'iblocks_many':
 * @property integer $id
 * @property integer $iblock_id
 * @property integer $type_iblock_id
 *
 * The followings are the available model relations:
 * @property Iblocks $iblock
 * @property TypesIblocks $typeIblock
 */
class IblocksMany extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return IblocksMany the static model class
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
		return 'iblocks_many';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iblock_id, type_iblock_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, iblock_id, type_iblock_id', 'safe', 'on'=>'search'),
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
			'iblock' => array(self::BELONGS_TO, 'Iblocks', 'iblock_id'),
			'typeIblock' => array(self::BELONGS_TO, 'TypesIblocks', 'type_iblock_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'iblock_id' => 'Iblock',
			'type_iblock_id' => 'Type Iblock',
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
		$criteria->compare('iblock_id',$this->iblock_id);
		$criteria->compare('type_iblock_id',$this->type_iblock_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}