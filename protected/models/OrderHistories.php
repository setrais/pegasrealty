<?php

/**
 * This is the model class for table "order_histories".
 *
 * The followings are the available columns in table 'order_histories':
 * @property integer $id
 * @property integer $order_id
 * @property string $createdate
 * @property string $updatedate
 * @property string $historydate
 * @property integer $createuser
 * @property integer $updateuser
 * @property integer $historyuser
 * @property integer $act
 * @property integer $del
 * @property integer $sort
 * @property integer $operation_id
 * @property string $price_from
 * @property string $price_to
 * @property integer $area_from
 * @property integer $area_to
 * @property integer $realestate_type_id
 * @property integer $realestate_vid_id
 * @property integer $realestate_class_id
 * @property integer $district_id
 * @property integer $valute_id
 * @property integer $unit_id
 * @property string $remoteness
 * @property string $unit_value
 * @property string $poligon
 *
 * The followings are the available model relations:
 * @property Orders $order
 */
class OrderHistories extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return OrderHistories the static model class
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
		return 'order_histories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('id', 'required'),
			array('id, order_id, createuser, updateuser, historyuser, act, del, sort, operation_id, area_from, area_to, realestate_type_id, realestate_vid_id, realestate_class_id, district_id, valute_id, unit_id', 'numerical', 'integerOnly'=>true),
			array('price_from, price_to, remoteness, unit_value', 'length', 'max'=>10),
			array('createdate, updatedate, historydate, poligon', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, createdate, updatedate, historydate, createuser, historyuser, updateuser, act, del, sort, operation_id, price_from, price_to, area_from, area_to, realestate_type_id, realestate_vid_id, realestate_class_id, district_id, valute_id, unit_id, remoteness, unit_value, poligon', 'safe', 'on'=>'search'),
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
			'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),                    	
                    	'unit' => array(self::BELONGS_TO, 'Units', 'unit_id'),
			'district' => array(self::BELONGS_TO, 'Districts', 'district_id'),
			'operation' => array(self::BELONGS_TO, 'Operations', 'operation_id'),
			'realestateClass' => array(self::BELONGS_TO, 'RealestateClasses', 'realestate_class_id'),
			'realestateType' => array(self::BELONGS_TO, 'RealestateTypes', 'realestate_type_id'),
			'realestateVid' => array(self::BELONGS_TO, 'RealestateVids', 'realestate_vid_id'),
			'valute' => array(self::BELONGS_TO, 'Valutes', 'valute_id'),
                        'updateUser' => array(self::BELONGS_TO, 'Users', 'updateuser'),
                        'createUser' => array(self::BELONGS_TO, 'Users', 'createuser'),
                        'historyUser' => array(self::BELONGS_TO, 'Users', 'createuser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label','ID'),
			'order_id' => Yii::t('label','Order'),
			'createdate' => Yii::t('label','Createdate'),
			'updatedate' => Yii::t('label','Updatedate'),
                        'historydate' => Yii::t('label','Historydate'),
			'createuser' => Yii::t('label','Createuser'),
			'updateuser' => Yii::t('label','Updateuser'),
                        'historyuser' => Yii::t('label','Historyuser'),
			'act' => Yii::t('label','Act'),
			'del' => Yii::t('label','Del'),
			'sort' => Yii::t('label','Sort'),
			'operation_id' => Yii::t('label','Operation'),
			'price_from' => Yii::t('label','Price From'),
			'price_to' => Yii::t('label','Price To'),
			'area_from' => Yii::t('label','Area From'),
			'area_to' => Yii::t('label','Area To'),
			'realestate_type_id' => Yii::t('label','Realestate Type'),
			'realestate_vid_id' => Yii::t('label','Realestate Vid'),
			'realestate_class_id' => Yii::t('label','Realestate Class'),
			'district_id' => Yii::t('label','District'),
			'valute_id' => Yii::t('label','Valute'),
			'unit_id' => Yii::t('label','Unit'),
			'remoteness' => Yii::t('label','Remoteness'),
			'unit_value' => Yii::t('label','Unit Value'),
			'poligon' => Yii::t('label','Poligon'),
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
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('updatedate',$this->updatedate,true);
		$criteria->compare('createuser',$this->createuser);
		$criteria->compare('updateuser',$this->updateuser);
		$criteria->compare('act',$this->act);
		$criteria->compare('del',$this->del);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('operation_id',$this->operation_id);
		$criteria->compare('price_from',$this->price_from,true);
		$criteria->compare('price_to',$this->price_to,true);
		$criteria->compare('area_from',$this->area_from);
		$criteria->compare('area_to',$this->area_to);
		$criteria->compare('realestate_type_id',$this->realestate_type_id);
		$criteria->compare('realestate_vid_id',$this->realestate_vid_id);
		$criteria->compare('realestate_class_id',$this->realestate_class_id);
		$criteria->compare('t.district_id',$this->district_id);
		$criteria->compare('valute_id',$this->valute_id);
		$criteria->compare('unit_id',$this->unit_id);
		$criteria->compare('remoteness',$this->remoteness,true);
		$criteria->compare('unit_value',$this->unit_value,true);
		$criteria->compare('poligon',$this->poligon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}